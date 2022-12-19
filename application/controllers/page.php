<?php
class Page extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('logged_in') !== TRUE) {
      redirect('login');
    }
  }

  function index()
  {
    if ($this->session->userdata('role') === '1') {
      $this->load->view('dashboard_view');
    } else {
      echo "Access Denied";
    }
  }

  function staff()
  {
    if ($this->session->userdata('role') === '2') {
      $this->load->view('dashboard_view');
    } else {
      echo "Access Denied";
    }
  }

  function author()
  {
    if ($this->session->userdata('role') === '3') {
      $this->load->view('dashboard_view');
    } else {
      echo "Access Denied";
    }
  }
}
