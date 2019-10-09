<?php


namespace fastsite\form;


use core\forms\BaseForm;
use core\forms\TextField;
use core\forms\CheckboxField;
use core\forms\SelectField;
use core\forms\validator\NotEmptyValidator;
use core\forms\HiddenField;

class FastsiteRedirectForm extends BaseForm {
    
    
    public function __construct() {
        parent::__construct();
        
        $this->addWidget( new HiddenField('redirect_id') );
        $this->addWidget(new CheckboxField('active', '', 'Actief'));
        
        $map = array();
        $map['exact']    = 'Exacte match';
        $map['regexp']   = 'Reguliere expressie';
        $map['wildcard'] = 'Wildcard';
        $this->addWidget(new SelectField('match_type', '', $map, 'Match-type'));
        
        
        $this->addWidget(new TextField('pattern', '', 'Patroon'));
        $this->addWidget(new TextField('redirect_url', '', 'Bestemmings url'));
        
        
        $this->addValidator('match_type', new NotEmptyValidator());
        
        $this->addValidator('pattern', new NotEmptyValidator());
        $this->addValidator('pattern', function($form) {
            $match_type = $form->getWidgetValue('match_type');
            $pattern = $form->getWidgetValue('pattern');
            
            if ($match_type == 'regexp' && valid_regexp($pattern) == false) {
                return 'Invalid regular expression';
            }
            
        });
        
        $this->addValidator('redirect_url', new NotEmptyValidator());
        
    }
    
}
