<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user') || $this->session->userdata('user')->role != 'admin') {
            redirect('auth/login');
        }
        $this->load->model('Loan_model');
    }

    public function dashboard() {
        $status = $this->input->get('status'); // Optional filter
        $data['loans'] = $this->Loan_model->getAllLoans($status);
        $this->load->view('admin/dashboard', $data);
    }

    public function update_status($loan_id, $status) {
        if (in_array($status, ['approved', 'rejected'])) {
            $this->Loan_model->updateLoanStatus($loan_id, $status);
        }
        redirect('admin/dashboard');
    }

    public function loan_detail($loan_id) {
        $loan = $this->db->select('loans.*, users.name, users.email')
                        ->from('loans')
                        ->join('users', 'users.id = loans.user_id')
                        ->where('loans.id', $loan_id)
                        ->get()->row();
        if (!$loan) show_404();

        $repayments = $this->Loan_model->getRepaymentsByLoan($loan_id);
        $total_repaid = $this->Loan_model->getTotalRepaid($loan_id);
        $balance = $loan->amount - $total_repaid;

        $data = compact('loan', 'repayments', 'total_repaid', 'balance');
        $this->load->view('admin/loan_detail', $data);
    }

    public function export_pdf($loan_id) {
        $this->load->model('Loan_model');
        $loan = $this->db->get_where('loans', ['id' => $loan_id])->row();
        $repayments = $this->Loan_model->getRepaymentsByLoan($loan_id);

        $html = $this->load->view('pdf/repayment_report', compact('loan', 'repayments'), TRUE);

        require_once APPPATH . 'third_party/dompdf/autoload.inc.php';
        $dompdf = new Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream("repayment_loan_{$loan_id}.pdf", array("Attachment" => false));
    }


}
