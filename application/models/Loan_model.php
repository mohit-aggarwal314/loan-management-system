<?php
class Loan_model extends CI_Model {

    public function applyLoan($data) {
        return $this->db->insert('loans', $data);
    }

    public function getLoansByUser($user_id) {
        return $this->db->get_where('loans', ['user_id' => $user_id])->result();
    }

    public function getAllLoans($status = null) {
    if ($status) {
        $this->db->where('status', $status);
    }
    $this->db->select('loans.*, users.name, users.email');
    $this->db->from('loans');
    $this->db->join('users', 'users.id = loans.user_id');
    return $this->db->get()->result();
    }

    public function updateLoanStatus($loan_id, $status) {
        return $this->db->update('loans', ['status' => $status], ['id' => $loan_id]);
    }

    public function getApprovedLoansByUser($user_id) {
    $this->db->where('user_id', $user_id);
    $this->db->where('status', 'approved');
    return $this->db->get('loans')->result();
    }

    public function submitRepayment($data) {
        return $this->db->insert('repayments', $data);
    }

    // Get repayments by loan ID
    public function getRepaymentsByLoan($loan_id) {
        return $this->db->get_where('repayments', ['loan_id' => $loan_id])->result();
    }

    // Calculate total repaid for a loan
    public function getTotalRepaid($loan_id) {
        $this->db->select_sum('amount');
        $this->db->where('loan_id', $loan_id);
        $result = $this->db->get('repayments')->row();
        return $result->amount ?? 0;
    }

}
