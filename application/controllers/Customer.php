<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user') || $this->session->userdata('user')->role != 'customer') {
            redirect('auth/login');
        }
        $this->load->model('Loan_model');
    }

    public function dashboard() {
        $user_id = $this->session->userdata('user')->id;
        $data['loans'] = $this->Loan_model->getLoansByUser($user_id);
        $this->load->view('customer/dashboard', $data);
    }

    public function apply_loan() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('amount', 'Loan Amount', 'required|numeric');
            $this->form_validation->set_rules('tenure', 'Tenure', 'required|numeric');
            $this->form_validation->set_rules('purpose', 'Purpose', 'required');

            if ($this->form_validation->run() == TRUE) {
                $loanData = [
                    'user_id' => $this->session->userdata('user')->id,
                    'amount' => $this->input->post('amount'),
                    'tenure' => $this->input->post('tenure'),
                    'purpose' => $this->input->post('purpose')
                ];
                $this->Loan_model->applyLoan($loanData);
                $this->session->set_flashdata('success', 'Loan application submitted.');
                redirect('customer/dashboard');
            }
        }
        $this->load->view('customer/apply_loan');
    }

    public function repay() {
        $user_id = $this->session->userdata('user')->id;
        $data['loans'] = $this->Loan_model->getApprovedLoansByUser($user_id);

        if ($this->input->post()) {
            $this->form_validation->set_rules('loan_id', 'Loan', 'required|numeric');
            $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');

            if ($this->form_validation->run() == TRUE) {
                $repayment = [
                    'loan_id' => $this->input->post('loan_id'),
                    'amount' => $this->input->post('amount'),
                ];
                $this->Loan_model->submitRepayment($repayment);
                $this->session->set_flashdata('success', 'Repayment submitted.');
                redirect('customer/repay');
            }
        }

        $this->load->view('customer/repay_form', $data);
        }

        public function loan_detail($loan_id) {
        $user_id = $this->session->userdata('user')->id;

        $loan = $this->db->get_where('loans', ['id' => $loan_id, 'user_id' => $user_id])->row();
        if (!$loan) show_404();

        $repayments = $this->Loan_model->getRepaymentsByLoan($loan_id);
        $total_repaid = $this->Loan_model->getTotalRepaid($loan_id);
        $balance = $loan->amount - $total_repaid;

        $data = compact('loan', 'repayments', 'total_repaid', 'balance');
        $this->load->view('customer/loan_detail', $data);
    }


}
