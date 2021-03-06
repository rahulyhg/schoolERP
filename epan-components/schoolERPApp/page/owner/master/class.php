<?php
class page_schoolERPApp_page_owner_master_class extends page_componentBase_page_owner_main{
  function page_index(){

    $col=$this->add('Columns');
    $col1=$col->addColumn(6);
    $class=$this->add('schoolERPApp/Model_Master_Class');
    // $class_field=$class->join('schoolERPApp_session','session_id');
    // $class_field->addField('session_name','Session')->type('readonly');
    $crud=$this->add('CRUD');
    $crud->setModel($class);

    if($crud->grid){
    $crud->grid->addColumn('expander','student');
    $crud->grid->addColumn('expander','subjects');
    // $sub=$this->add('Model_Subject');
    }
   }
    function page_student(){
      $this->api->stickyGET('class_id');
      $student=$this->add('schoolERPApp/Model_School_Student');
      $student->addCondition('class_id',$_GET['schoolERPApp_class_id']);
      $grid=$this->add('CRUD',array('allow_add'=>false,'allow_edit'=>false,'allow_del'=>false));
      $grid->setModel($student,array('name','gender','Father_name','phone_number'));

    }
    function page_subjects(){
    $this->api->stickyGET('schoolERPApp_class_id');
    $subject=$this->add('schoolERPApp/Model_Master_Subject');
    $subject->addCondition('class_id',$_GET['schoolERPApp_class_id']);
    $crud=$this->add('CRUD',array('allow_add'=>true,'allow_edit'=>true,'allow_del'=>true));

    if($_GET['deactive']){

    if($crud->grid)
    $subject->load($_GET['deactive']);
    $subject['is_active']=!$subject['is_active'];
    $subject->save();
    $crud->grid->js()->reload()->execute();
        }

    if($crud->grid){
    $crud->grid->addColumn('button','deactive');
    }
    $crud->setModel($subject);
   
        
      }
    }
