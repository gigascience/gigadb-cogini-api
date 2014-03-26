"""
soapdenovo1.py
A wrapper script for SOAPdenovo-1.0
Copyright   Peter Li - GigaScience and BGI-HK
            Huayan Gao - CUHK
The scrollbar code is borrowed from the following website,         
http://effbot.org/zone/tkinter-autoscrollbar.htm
"""

import optparse, os, shutil, subprocess, sys, tempfile, urllib2 
import xml.etree.ElementTree as ET

import urllib

from Tkinter import *      

def stop_err(msg):
    sys.stderr.write(msg)
    sys.exit()
       
class AutoScrollbar(Scrollbar):
    # a scrollbar that hides itself if it's not needed.  only
    # works if you use the grid geometry manager.
    def set(self, lo, hi):
        if float(lo) <= 0.0 and float(hi) >= 1.0:
            # grid_remove is currently missing from Tkinter!
            self.tk.call("grid", "remove", self)
        else:
            self.grid()
        Scrollbar.set(self, lo, hi)
    def pack(self, **kw):
        raise TclError, "cannot use pack with this widget"
    def place(self, **kw):
        raise TclError, "cannot use place with this widget"  

def main():
    author = sys.argv[1]
    
    url= "http://localhost/api/author/"+author;
    output_id = sys.argv[2]
    #where to store files that become additional output
    database_tmp_dir =  sys.argv[3]    
    gigadboutput = sys.argv[4]
    out_files = {}
    
    title = "test only"
    
    data = urllib2.urlopen(url)
    tree = ET.parse(data)
    root = tree.getroot()
    totaldatasets = root.get('TotalDatasets')
    #print totaldatasets
		    
    rt = Tk()
    rt.withdraw()
    top = Toplevel(rt)
    top.minsize(500,500)   
    top.maxsize(500,1500)  
    top.geometry("+300+150")
    vscrollbar = AutoScrollbar(top)
    vscrollbar.grid(row=0, column=1, sticky=N+S)
    hscrollbar = AutoScrollbar(top, orient=HORIZONTAL)
    hscrollbar.grid(row=1, column=0, sticky=E+W)

    canvas = Canvas(top, 
                yscrollcommand=vscrollbar.set, 
                xscrollcommand=hscrollbar.set)
    canvas.grid(row=0, column=0, sticky=N+S+E+W)

    vscrollbar.config(command=canvas.yview)
    hscrollbar.config(command=canvas.xview)
            
    frame = Frame(canvas)
    top.title("GigaDB Data Import")
    top.rowconfigure( 0, weight = 1 )
    top.columnconfigure( 0, weight = 1 )
    frame.grid( sticky = W+E+N+S )

    var = StringVar()
    label = Label(frame, textvariable=var,bg="green",  anchor=W, justify=LEFT,wraplength=500,padx=5, pady=5)
    var.set("Here are the list of papers by the author: "+author)     
    label.grid( columnspan = 3,sticky = W+E+N+S )
    
    var_radio = StringVar()
    var_radio.set("1")
    C={}

    for i in range(int(totaldatasets)):
        totalfiles = root[i].find('Files').get('TotalFiles')
    	#print 'Total files associated with this paper is: '+totalfiles
    	title = root[i].find('Title').text.encode('ascii','ignore')    	
    	doi = root[i].find('DOI').text.encode('ascii','ignore')
    	authorname = root[i].find('Authors').find('AuthorName').text.encode('ascii','ignore')
    	#doi
        C[i]=Radiobutton(frame, text = doi, variable = var_radio, value = doi,padx=5)
        C[i].grid(row=i+1, column=0, sticky=W)
        #authorname
        var_author = StringVar()
        label_author = Label(frame, textvariable=var_author, wraplength=300,padx=5)
        var_author.set(authorname)
        label_author.grid(row=i+1,column=1,sticky = W )        
        #title
        var_title = StringVar()
        label_title = Label(frame, textvariable=var_title, wraplength=300,justify=LEFT,padx=5)
        var_title.set(title)
        label_title.grid(row=i+1,column=2,sticky = W )
    i=i+1	
    #print i
	
    test = 'Get the Selected DOI'
    button=Button(frame,text = test ,bg='green',command = top.quit)
    button.grid(row=i+2, columnspan=3, sticky =W+E+N+S )
    
    frame.rowconfigure( 1, weight = 1 )
    frame.columnconfigure( 1, weight = 1 )
    
    canvas.create_window(0, 0, anchor=NW, window=frame)

    frame.update_idletasks()

    canvas.config(scrollregion=canvas.bbox("all"))
    
    top.mainloop()
    #print var_radio.get()
    

    #second window, select the files associated the selected doi
    doi = var_radio.get()
    url= "http://localhost/api/dataset/"+doi;
    #where to store files that become additional output
    out_files = {}
    
    data = urllib2.urlopen(url)
    tree = ET.parse(data)
    root = tree.getroot()
    totalfiles = root.find('Files').get('TotalFiles')
    #print 'Total files associated with this paper is: '+totalfiles
    title = root.find('Title').text.encode('ascii','ignore')    
    description = root.find('Description').text.encode('ascii','ignore')    
    #print title, description
	
    top = Toplevel(rt)
    top.minsize(500,500)   
    top.maxsize(500,1500)  
    top.geometry("+300+150")
    vscrollbar = AutoScrollbar(top)
    vscrollbar.grid(row=0, column=1, sticky=N+S)
    hscrollbar = AutoScrollbar(top, orient=HORIZONTAL)
    hscrollbar.grid(row=1, column=0, sticky=E+W)

    canvas = Canvas(top, 
                yscrollcommand=vscrollbar.set, 
                xscrollcommand=hscrollbar.set)
    canvas.grid(row=0, column=0, sticky=N+S+E+W)

    vscrollbar.config(command=canvas.yview)
    hscrollbar.config(command=canvas.xview)
            
    frame = Frame(canvas)
    top.title("GigaDB Data Import")
    top.rowconfigure( 0, weight = 1 )
    top.columnconfigure( 0, weight = 1 )
    frame.grid( sticky = W+E+N+S )

    var = StringVar()
    label = Label(frame, textvariable=var,bg="green",  anchor=W, justify=LEFT,wraplength=500,padx=5, pady=5)
    var.set("Please select the files you'd like to import to GigaGalaxy for the paper:\n"+title)     
    label.grid( columnspan = 2,sticky = W+E+N+S )
    
    CheckVar = {}
    file_location = {}
    C={}
    i=1
    for file in root[8].findall('File'):
        file_name=str(i)+':'+file.find('FileName').text
        file_size = file.find('Size').text
        file_location[i]=file.find('FileLocation').text
        file_extension=file.find('FileExtension').text
        #print file_name,file_location,file_extension  
        out_files[i]= os.path.join( database_tmp_dir, 'primary_%s_%s_visible_%s' % ( output_id, i, file_extension ) )
        CheckVar[i]=IntVar()
        C[i]=Checkbutton(frame, text = file_name, variable = CheckVar[i], padx=5,\
                 onvalue = 1, offvalue = 0, wraplength=450)
        C[i].grid(row=i, column=0, sticky=W)
        var_size = StringVar()
        label_size = Label(frame, textvariable=var_size, padx=5)
        var_size.set(file_size)
        label_size.grid(row=i,column=1,sticky = W )
        i=i+1

    button=Button(frame,text = 'Get the Selected Data',bg='green',command = top.quit)
    button.grid(row=i, columnspan=2, sticky =W+E+N+S )
    
    frame.rowconfigure( 1, weight = 1 )
    frame.columnconfigure( 1, weight = 1 )
    
    canvas.create_window(0, 0, anchor=NW, window=frame)

    frame.update_idletasks()

    canvas.config(scrollregion=canvas.bbox("all"))
    
    top.mainloop()
    
    k=0    
    for j in range(1,i): 
    	#print j
        if CheckVar[j].get():
        	k=k+1
        	#print k
        	out = open(out_files[j], 'wb+')
    		try:
        	    page = urllib.urlretrieve(file_location[j], out_files[j])
    		except Exception, e:
    			print 'Error getting the data -> %s' % e
    		out.close()
    		
    #print "The total number of files you selected is %s: " % k     
     
    out = open(gigadboutput, 'wb')
    try:
    	page = urllib2.urlopen(url)    	
        out.write('The files you selected will be output in the next %s output files.'% k)
    except Exception, e:
    	print 'Error getting the data -> %s' % e
    out.close()
        
    #Check results in output file
    if k > 0:
        sys.stdout.write('Status complete')
    else:
        stop_err("Please select the files you'd like to import to GigaGalaxy first!")
   
if __name__ == "__main__":
    main()
