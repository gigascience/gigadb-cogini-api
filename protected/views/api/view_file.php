<?php header("Content-type: text/xml"); ?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<?php 
    echo "<File>";
    echo "<".str_replace(" ", "", CHtml::encode($model->getAttributeLabel('name'))).">";
    echo CHtml::encode($model->name);
    echo "</".str_replace(" ", "", CHtml::encode($model->getAttributeLabel('name'))).">"; 
    echo "<".str_replace(" ", "", CHtml::encode($model->getAttributeLabel('location'))).">";
    echo CHtml::encode($model->location);
    echo "</".str_replace(" ", "", CHtml::encode($model->getAttributeLabel('location'))).">";         
    echo "<".str_replace(" ", "", CHtml::encode($model->getAttributeLabel('extension'))).">";
    echo CHtml::encode($model->extension);
    echo "</".str_replace(" ", "", CHtml::encode($model->getAttributeLabel('extension'))).">";         
    echo "<".str_replace(" ", "", CHtml::encode($model->getAttributeLabel('size'))).">";
    echo CHtml::encode(File::staticBytesToSize($model->size));
    echo "</".str_replace(" ", "", CHtml::encode($model->getAttributeLabel('size'))).">";         
    echo "<".str_replace(" ", "", CHtml::encode($model->getAttributeLabel('description'))).">";
    echo CHtml::encode($model->description);
    echo "</".str_replace(" ", "", CHtml::encode($model->getAttributeLabel('description'))).">";         
    echo "</File>";   
?>