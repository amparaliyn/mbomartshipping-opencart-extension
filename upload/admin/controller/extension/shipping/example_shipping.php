<?php
class ControllerExtensionShippingExampleShipping extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('extension/shipping/example_shipping');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('shipping_example_shipping', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=shipping', true));
        }

        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_edit'] = $this->language->get('text_edit');
        $data['entry_cost'] = $this->language->get('entry_cost');
        $data['entry_tax_class'] = $this->language->get('entry_tax_class');
        $data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        $this->response->setOutput($this->load->view('extension/shipping/example_shipping', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/shipping/example_shipping')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }
}