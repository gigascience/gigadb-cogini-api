<?php header("Content-type: text/xml"); ?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<?php 
    echo '<root>'; 
    echo "<Dataset>";
    echo "<".CHtml::encode($model->getAttributeLabel('identifier')).">"; 
    echo CHtml::encode($model->identifier);
    echo "</".CHtml::encode($model->getAttributeLabel('identifier')).">"; 
    
    echo "<".CHtml::encode($model->getAttributeLabel('title')).">"; 
    echo CHtml::encode($model->title);
    echo "</".CHtml::encode($model->getAttributeLabel('title')).">"; 
        
    echo "<".CHtml::encode($model->getAttributeLabel('description')).">"; 
    echo CHtml::encode($model->description);
    echo "</".CHtml::encode($model->getAttributeLabel('description')).">";  
    
    echo "<Images>";
    echo "<".str_replace(" ", "", CHtml::encode($model->image->getAttributeLabel('location'))).">"; 
    echo CHtml::encode($model->image->location);
    echo "</".str_replace(" ", "", CHtml::encode($model->image->getAttributeLabel('location'))).">"; 
    echo "<".str_replace(" ", "", CHtml::encode($model->image->getAttributeLabel('photographer'))).">"; 
    echo CHtml::encode($model->image->photographer);
    echo "</".str_replace(" ", "", CHtml::encode($model->image->getAttributeLabel('photographer'))).">";
    echo "<".str_replace(" ", "", CHtml::encode($model->image->getAttributeLabel('url'))).">"; 
    echo CHtml::encode($model->image->url);
    echo "</".str_replace(" ", "", CHtml::encode($model->image->getAttributeLabel('url'))).">";
    echo "<".str_replace(" ", "", CHtml::encode($model->image->getAttributeLabel('tag'))).">"; 
    echo CHtml::encode($model->image->tag);
    echo "</".str_replace(" ", "", CHtml::encode($model->image->getAttributeLabel('tag'))).">";
    echo "<".str_replace(" ", "", CHtml::encode($model->image->getAttributeLabel('license'))).">"; 
    echo CHtml::encode($model->image->license);
    echo "</".str_replace(" ", "", CHtml::encode($model->image->getAttributeLabel('license'))).">";
    echo "<".str_replace(" ", "", CHtml::encode($model->image->getAttributeLabel('source'))).">"; 
    echo CHtml::encode($model->image->source);
    echo "</".str_replace(" ", "", CHtml::encode($model->image->getAttributeLabel('source'))).">";
    echo "</Images>";
    
    echo "<Authors TotalAuthors='".count($model->authors)."'>";
    foreach ($model->authors as $author) {
        echo "<".str_replace(" ", "", CHtml::encode($author->getAttributeLabel('name'))).">";
        echo CHtml::encode($author->name);
        echo "</".str_replace(" ", "", CHtml::encode($author->getAttributeLabel('name'))).">";     
    }
    echo "</Authors>";
    
    echo "<Projects TotalProjects='".count($model->projects)."'>";
    foreach ($model->projects as $project) {
        echo "<Project>";
        echo "<".str_replace(" ", "", CHtml::encode($project->getAttributeLabel('name'))).">";
        echo CHtml::encode($project->name);
        echo "</".str_replace(" ", "", CHtml::encode($project->getAttributeLabel('name'))).">";         
        echo "<".str_replace(" ", "", CHtml::encode($project->getAttributeLabel('url'))).">";
        echo CHtml::encode($project->url);
        echo "</".str_replace(" ", "", CHtml::encode($project->getAttributeLabel('url'))).">"; 
        echo "</Project>";
    }
    echo "</Projects>";

    echo "<Manuscripts TotalManuscripts='".count($model->manuscripts)."'>";
    foreach ($model->manuscripts as $manuscript) {
        echo "<Manuscript>";
        echo "<".str_replace(" ", "", CHtml::encode($manuscript->getAttributeLabel('identifier'))).">";
        echo CHtml::encode($manuscript->identifier);
        echo "</".str_replace(" ", "", CHtml::encode($manuscript->getAttributeLabel('identifier'))).">";         
        echo "<".str_replace(" ", "", CHtml::encode($manuscript->getAttributeLabel('pmid'))).">";
        echo CHtml::encode($manuscript->pmid);
        echo "</".str_replace(" ", "", CHtml::encode($manuscript->getAttributeLabel('pmid'))).">"; 
        echo "</Manuscript>";
    }
    echo "</Manuscripts>";

    echo "<Samples TotalSamples='".count($model->samples)."'>";
    foreach ($model->samples as $sample) {
        echo "<Sample>";
        echo "<".str_replace(" ", "", CHtml::encode($sample->getAttributeLabel('code'))).">";
        echo CHtml::encode($sample->code);
        echo "</".str_replace(" ", "", CHtml::encode($sample->getAttributeLabel('code'))).">";         
        echo "<".str_replace(" ", "", CHtml::encode($sample->getAttributeLabel('s_attrs'))).">";
        echo CHtml::encode($sample->s_attrs);
        echo "</".str_replace(" ", "", CHtml::encode($sample->getAttributeLabel('s_attrs'))).">"; 
        echo "<".str_replace(" ", "", CHtml::encode($sample->species->getAttributeLabel('common_name'))).">";
        echo CHtml::encode($sample->species->common_name);
        echo "</".str_replace(" ", "", CHtml::encode($sample->species->getAttributeLabel('common_name'))).">"; 
        echo "<".str_replace(" ", "", CHtml::encode($sample->species->getAttributeLabel('genbank_name'))).">";
        echo CHtml::encode($sample->species->genbank_name);
        echo "</".str_replace(" ", "", CHtml::encode($sample->species->getAttributeLabel('genbank_name'))).">"; 
        echo "<".str_replace(" ", "", CHtml::encode($sample->species->getAttributeLabel('scientific_name'))).">";
        echo CHtml::encode($sample->species->scientific_name);
        echo "</".str_replace(" ", "", CHtml::encode($sample->species->getAttributeLabel('scientific_name'))).">"; 
        echo "<".str_replace(" ", "", CHtml::encode($sample->species->getAttributeLabel('tax_id'))).">";
        echo CHtml::encode($sample->species->tax_id);
        echo "</".str_replace(" ", "", CHtml::encode($sample->species->getAttributeLabel('tax_id'))).">"; 
        echo "</Sample>";
    }
    echo "</Samples>";    
    
    echo "<Files TotalFiles='".count($model->files)."'>";
    foreach ($model->files as $file) {
        echo "<File>";
        echo "<".str_replace(" ", "", CHtml::encode($file->getAttributeLabel('name'))).">";
        echo CHtml::encode($file->name);
        echo "</".str_replace(" ", "", CHtml::encode($file->getAttributeLabel('name'))).">"; 
        echo "<".str_replace(" ", "", CHtml::encode($file->getAttributeLabel('location'))).">";
        echo CHtml::encode($file->location);
        echo "</".str_replace(" ", "", CHtml::encode($file->getAttributeLabel('location'))).">";         
        echo "<".str_replace(" ", "", CHtml::encode($file->getAttributeLabel('extension'))).">";
        echo CHtml::encode($file->extension);
        echo "</".str_replace(" ", "", CHtml::encode($file->getAttributeLabel('extension'))).">";         
        echo "<".str_replace(" ", "", CHtml::encode($file->getAttributeLabel('size'))).">";
        echo CHtml::encode(File::staticBytesToSize($file->size));
        echo "</".str_replace(" ", "", CHtml::encode($file->getAttributeLabel('size'))).">";         
        echo "<".str_replace(" ", "", CHtml::encode($file->getAttributeLabel('description'))).">";
        echo CHtml::encode($file->description);
        echo "</".str_replace(" ", "", CHtml::encode($file->getAttributeLabel('description'))).">";         
        echo "</File>";
    }
    echo "</Files>";    
    
    echo "<Publisher>";    
    echo "<".str_replace(" ", "",CHtml::encode($model->publisher->getAttributeLabel('name'))).">"; 
    echo CHtml::encode($model->publisher->name);
    echo "</".str_replace(" ", "",CHtml::encode($model->publisher->getAttributeLabel('name'))).">";      
    echo "<".str_replace(" ", "",CHtml::encode($model->publisher->getAttributeLabel('description'))).">"; 
    echo CHtml::encode($model->publisher->description);
    echo "</".str_replace(" ", "",CHtml::encode($model->publisher->getAttributeLabel('description'))).">"; 
    echo "</Publisher>"; 
        
    echo "<".str_replace(" ", "", CHtml::encode($model->getAttributeLabel('publication_date'))).">"; 
    echo CHtml::encode($model->publication_date);
    echo "</".str_replace(" ", "", CHtml::encode($model->getAttributeLabel('publication_date'))).">"; 
?>
<?php echo "</Dataset>"; ?>
<?php echo "</root>"; ?>