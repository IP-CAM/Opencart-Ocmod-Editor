<?php 

class ControllerExtensionModuleOcmodMirror extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('catalog/product');
		$this->load->language('extension/module/ocmodmirror');
		
		$data = array();
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/ocmodmirror', 'user_token=' . $this->session->data['user_token'], true)
		);
		$data['action'] = $this->url->link('extension/module/ocmodmirror/save', 'user_token=' . $this->session->data['user_token'], true);

		$this->document->addStyle('view/javascript/ocmodmirror/codemirror.css');
		$this->document->addStyle('view/javascript/ocmodmirror/theme/material.css');
		$this->document->addStyle('view/javascript/ocmodmirror/theme/monokai.css');
		$this->document->addStyle('view/javascript/ocmodmirror/theme/lucario.css');
		$this->document->addStyle('view/javascript/ocmodmirror/addon/dialog/dialog.css');
		$this->document->addStyle('view/javascript/ocmodmirror/addon/fold/foldgutter.css');
		$this->document->addStyle('view/javascript/ocmodmirror/vendor.css');

		$this->document->addScript('view/javascript/ocmodmirror/codemirror.js');
		$this->document->addScript('view/javascript/ocmodmirror/addon/search/search.js');
		$this->document->addScript('view/javascript/ocmodmirror/addon/search/searchcursor.js');
		$this->document->addScript('view/javascript/ocmodmirror/addon/search/jump-to-line.js');
		$this->document->addScript('view/javascript/ocmodmirror/addon/search/match-highlighter.js');
		$this->document->addScript('view/javascript/ocmodmirror/addon/fold/brace-fold.js');
		$this->document->addScript('view/javascript/ocmodmirror/addon/fold/comment-fold.js');
		$this->document->addScript('view/javascript/ocmodmirror/addon/fold/foldcode.js');
		$this->document->addScript('view/javascript/ocmodmirror/addon/fold/foldgutter.js');
		$this->document->addScript('view/javascript/ocmodmirror/addon/fold/foldgutter.js');
		$this->document->addScript('view/javascript/ocmodmirror/addon/fold/indent-fold.js');
		$this->document->addScript('view/javascript/ocmodmirror/addon/fold/markdown-fold.js');
		$this->document->addScript('view/javascript/ocmodmirror/addon/fold/xml-fold.js');
		$this->document->addScript('view/javascript/ocmodmirror/addon/dialog/dialog.js');
		$this->document->addScript('view/javascript/ocmodmirror/addon/edit/matchbrackets.js');
		$this->document->addScript('view/javascript/ocmodmirror/addon/edit/closebrackets.js');
		$this->document->addScript('view/javascript/ocmodmirror/addon/comment/comment.js');
		$this->document->addScript('view/javascript/ocmodmirror/addon/wrap/hardwrap.js');
		$this->document->addScript('view/javascript/ocmodmirror/keymap/sublime.js');
		$this->document->addScript('view/javascript/ocmodmirror/mode/xml/xml.js');
		$this->document->addScript('view/javascript/ocmodmirror/vendor.js');

		$data['error_warning'] = '';
		$data['error_success'] = '';

		$modification_id = isset($this->request->get['modification_id']) ? $this->request->get['modification_id'] : 0;

		$this->load->model('setting/modification');
		$row = $this->model_setting_modification->getModification($modification_id);
		$data['xml'] = isset($row['xml']) ? $row['xml'] : '';

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/ocmodmirror', $data));
	}

	public function save() {

	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/ocmodmirror')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}