<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_tour($limit, $start)
    {
        $this->db->select('tour.*,user.user_name');
        $this->db->from('schedule');
        // Join
        $this->db->join('user', 'user.id = tour.user_id', 'LEFT');
        //End Join
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function listschedule($tour_id)
    {
        $date_now = date("Y-m-d");
        $this->db->select('*');
        $this->db->from('schedule');
        $this->db->where([
            'tour_id'           => $tour_id,
            'schedule_date >'   => $date_now,
        ]);
        // $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function detail($id)
    {
        $this->db->select('*');
        $this->db->from('schedule');
        $this->db->where('id', $id);
        // $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function detail_order($id)
    {
        $this->db->select('schedule.*,tour.tour_duration, tour.tour_title, tour.tour_title_en, tour.tour_description, tour.tour_description_en, tour.tour_facility, tour.tour_facility_en, tour.tour_image,');
        $this->db->from('schedule');
        // Join
        $this->db->join('tour', 'tour.id = schedule.tour_id', 'LEFT');
        //End Join
        $this->db->where('md5(schedule.id)', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function create($data)
    {
        $this->db->insert('schedule', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('schedule', $data);
    }
    public function update_stock($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('schedule', $data);
    }
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('schedule', $data);
    }
    public function schedule_detail($schedule_id)
    {
        $this->db->select('*');
        $this->db->from('schedule');
        $this->db->where('id', $schedule_id);
        // $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_schedule($start_date)
    {
        $this->db->select('schedule.*, tour.tour_price, tour.tour_views, tour.tour_slug,tour.tour_duration, tour.tour_title, tour.tour_title_en, tour.tour_description, tour.tour_description_en, tour.tour_facility, tour.tour_facility_en, tour.tour_image,');
        $this->db->from('schedule');
        // Join
        $this->db->join('tour', 'tour.id = schedule.tour_id', 'LEFT');
        //End Join
        $this->db->group_by('tour_id');
        $this->db->where('schedule_date', $start_date);
        // $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
}
