<?php


use core\controller\BaseController;
use core\exception\FileException;
use core\exception\InvalidStateException;

class fileEditorController extends BaseController {
    
    
    public function action_index() {
        $p = get_data_file('fastsite/templates/'.basename(get_var('n')));
        
        if (!$p)
            throw new InvalidStateException('Template not found');
        
        
        $this->templateName = get_var('n');
        $this->files = list_files($p, ['recursive' => true, 'append-slash' => true]);
        
        usort($this->files, function($o1, $o2) {
            
            
            if (strpos($o1, '.htm') !== false && strpos($o2, '.htm') === false) {
                return -1;
            }
            if (strpos($o1, '.htm') === false && strpos($o2, '.htm') !== false) {
                return 1;
            }
            
            
            if (strpos($o1, '/') === false && strpos($o2, '/') !== false) {
                return -1;
            } else if (strpos($o1, '/') !== false && strpos($o2, '/') === false) {
                return 1;
            }
            
            
            return strcmp($o1, $o2);
        });
        
        $this->controller = $this;
        
        
        return $this->render();
    }
    
    
    
    
    public function action_delete() {
        $tn = basename(get_var('n'));
        
        // delete file/directory
        $templateFolder = get_data_file_safe('fastsite/templates', $tn);
        
        if (!$templateFolder) {
            throw new FileException('Template folder not found');
        }
        
        $f = get_data_file_safe('fastsite/templates/'.$tn, get_var('f'));
        
        if (!$f) {
            throw new FileException('File not found');
        }
        
        if (!unlink($f)) {
            report_user_error('Error deleting file or directory');
        }
        
        redirect('/?m=fastsite&c=template/fileEditor&n=' . $tn);
    }
    
    public function extensionSupported($file) {
        $p = strrpos($file, '.');
        
        if ($p === false) return false;
        
        $extension = strtolower( substr($file, $p+1) );
        
        return in_array($extension, ['css', 'map', 'php', 'js', 'json', 'html', 'htm', 'scss', 'sass', 'yml']) ? true : false;
    }
    
    public function editorMode($file) {
        $ext = file_extension($file);
        
        if ($ext == 'css') {
            return 'css';
        } else if ($ext == 'scss') {
            return 'text/x-less';
        } else if ($ext == 'js' || $ext == 'json' || $ext == 'map') {
            return 'javascript';
        } else if ($ext == 'xml') {
            return 'xml';
        } else if ($ext == 'yml' || $ext == 'yaml') {
            return 'yaml';
        }
    
        
        return 'htmlmixed';
    }
    
    public function codemirrorOptions($file) {
        $ext = file_extension( $file );
        
        $opts = array();
        
        $opts['lineNumbers'] = true;
        $opts['mode'] = $this->editorMode( $file );
        $opts['matchBrackets'] = in_array($ext, array('css', 'js', 'scss'));
        
        return $opts;
    }
    
    public function action_editfile() {
        $this->templateName = $templateName = basename( get_var('n') );
        $this->file = $file = get_var('f');
        $this->controller = $this;
        
        $templateDir = get_data_file('fastsite/templates');
        
        $f = get_data_file('fastsite/templates/'.$templateName.'/'.$file);
        
        // check if file is in template dir
        if (strpos($f, $templateDir) === false) {
            $this->error = t('File not found');
            return $this->render();
        }
        
        if (is_dir($f)) {
            $this->error = t('Selected file is a directory');
            return $this->render();
        }
        
        if ($this->extensionSupported($f) == false) {
            $this->error = t('File extension not supported for editing');
            return $this->render();
        }
        
        if (is_post()) {
            $content = get_var('tacontent');
            if (file_put_contents($f, $content)) {
                report_user_message('File saved');
            } else {
                report_user_error('Error saving file');
            }
            
            redirect('/?m=fastsite&c=template/fileEditor&a=editfile&n='.urlencode($this->templateName).'&f='.urlencode($this->file));
        }
        
//         $this->setShowDecorator(false);
        $this->content = file_get_contents( $f );
        
        return $this->render();
    }
    
    
    
    
    
}
