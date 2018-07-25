CREATE TABLE academic_year (
    academic_year_id integer NOT NULL,
    start_date date,
    end_date date,
    active boolean DEFAULT true,
    start_year integer,
    end_year integer
);
ALTER TABLE public.academic_year OWNER TO postgres;

CREATE TABLE base_benefit (
    base_benefit_id integer NOT NULL,
    max_benefit real,
    min_months integer,
    max_months integer,
    employee_type_id integer,
    employee_status character varying,
    active boolean DEFAULT true,
    max_convertible real
);
ALTER TABLE public.base_benefit OWNER TO postgres;

CREATE SEQUENCE base_benefit_base_benefit_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.base_benefit_base_benefit_id_seq OWNER TO postgres;
ALTER SEQUENCE base_benefit_base_benefit_id_seq OWNED BY base_benefit.base_benefit_id;

CREATE TABLE base_leave (
    base_leave_id integer NOT NULL,
    max_leave integer,
    max_convertible integer,
    min_months integer,
    max_months integer,
    leave_type_id integer,
    employee_type_id integer,
    employee_status character varying,
    active boolean DEFAULT true
);
ALTER TABLE public.base_leave OWNER TO postgres;

CREATE SEQUENCE base_leave_base_leave_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.base_leave_base_leave_id_seq OWNER TO postgres;
ALTER SEQUENCE base_leave_base_leave_id_seq OWNED BY base_leave.base_leave_id;

CREATE TABLE base_points (
    base_points_id integer NOT NULL,
    criteria_id integer,
    employee_type_id integer,
    base_description character varying,
    base_points integer
);
ALTER TABLE public.base_points OWNER TO postgres;

CREATE SEQUENCE base_points_base_points_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.base_points_base_points_id_seq OWNER TO postgres;
ALTER SEQUENCE base_points_base_points_id_seq OWNED BY base_points.base_points_id;

CREATE TABLE certification_board (
    certification_board_id integer NOT NULL,
    employee_type_id integer,
    certification_board_type_id integer,
    certification_board_detail_id integer,
    cert_points integer
);
ALTER TABLE public.certification_board OWNER TO postgres;

CREATE TABLE certification_board_acquired (
    certification_board_acquired_id integer NOT NULL,
    certification_board_id integer,
    cert_board_description character varying,
    cert_date date,
    employee_id integer
);
ALTER TABLE public.certification_board_acquired OWNER TO postgres;

CREATE SEQUENCE certification_board_acquired_certification_board_acquired_i_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.certification_board_acquired_certification_board_acquired_i_seq OWNER TO postgres;
ALTER SEQUENCE certification_board_acquired_certification_board_acquired_i_seq OWNED BY certification_board_acquired.certification_board_acquired_id;

CREATE SEQUENCE certification_board_certification_board_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.certification_board_certification_board_id_seq OWNER TO postgres;
ALTER SEQUENCE certification_board_certification_board_id_seq OWNED BY certification_board.certification_board_id;

CREATE TABLE certification_board_detail (
    certification_board_detail_id integer NOT NULL,
    cert_detail character varying
);
ALTER TABLE public.certification_board_detail OWNER TO postgres;

CREATE SEQUENCE certification_board_detail_certification_board_detail_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.certification_board_detail_certification_board_detail_id_seq OWNER TO postgres;
ALTER SEQUENCE certification_board_detail_certification_board_detail_id_seq OWNED BY certification_board_detail.certification_board_detail_id;

CREATE TABLE certification_board_type (
    certification_board_type_id integer NOT NULL,
    cert_type character varying
);
ALTER TABLE public.certification_board_type OWNER TO postgres;

CREATE SEQUENCE certification_board_type_certification_board_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.certification_board_type_certification_board_type_id_seq OWNER TO postgres;
ALTER SEQUENCE certification_board_type_certification_board_type_id_seq OWNED BY certification_board_type.certification_board_type_id;

CREATE TABLE criteria (
    criteria_id integer NOT NULL,
    criteria_description character varying
);
ALTER TABLE public.criteria OWNER TO postgres;

CREATE SEQUENCE criteria_criteria_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.criteria_criteria_id_seq OWNER TO postgres;
ALTER SEQUENCE criteria_criteria_id_seq OWNED BY criteria.criteria_id;

CREATE TABLE education (
    education_id integer NOT NULL,
    educational_attainment_id integer,
    course_description character varying,
    school_description character(1),
    employee_id integer
);
ALTER TABLE public.education OWNER TO postgres;

CREATE TABLE education_detail (
    education_detail_id integer NOT NULL,
    detail character varying
);
ALTER TABLE public.education_detail OWNER TO postgres;

CREATE SEQUENCE education_detail_id_education_detail_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.education_detail_id_education_detail_id_seq OWNER TO postgres;
ALTER SEQUENCE education_detail_id_education_detail_id_seq OWNED BY education_detail.education_detail_id;

CREATE SEQUENCE education_education_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.education_education_id_seq OWNER TO postgres;
ALTER SEQUENCE education_education_id_seq OWNED BY education.education_id;

CREATE TABLE education_level (
    education_level_id integer NOT NULL,
    level_description character varying
);
ALTER TABLE public.education_level OWNER TO postgres;

CREATE SEQUENCE education_level_education_level_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.education_level_education_level_id_seq OWNER TO postgres;
ALTER SEQUENCE education_level_education_level_id_seq OWNED BY education_level.education_level_id;

CREATE TABLE educational_attainment (
    educational_attainment_id integer NOT NULL,
    employee_type_id integer,
    education_level_id integer,
    education_detail_id integer,
    educ_points integer
);
ALTER TABLE public.educational_attainment OWNER TO postgres;

CREATE SEQUENCE educational_attainment_educational_attainment_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.educational_attainment_educational_attainment_id_seq OWNER TO postgres;
ALTER SEQUENCE educational_attainment_educational_attainment_id_seq OWNED BY educational_attainment.educational_attainment_id;

CREATE TABLE employee_information (
    employee_id integer NOT NULL,
    first_name character varying(100),
    middle_name character varying(100),
    last_name character varying(100),
    gender character varying(10),
    address character varying(100),
    mobile_num character varying(30),
    work_email character varying(100),
    username character varying(30),
    password character varying(32),
    active boolean DEFAULT true,
    employee_type_id integer,
    user_type_id integer,
    display_picture text DEFAULT 'user-image.png'::text,
    job_position_id integer,
    managerial_exp integer,
    birthdate date
);
ALTER TABLE public.employee_information OWNER TO postgres;

CREATE SEQUENCE employee_information_employee_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.employee_information_employee_id_seq OWNER TO postgres;
ALTER SEQUENCE employee_information_employee_id_seq OWNED BY employee_information.employee_id;

CREATE TABLE employee_medical_record (
    employee_medical_record_id integer NOT NULL,
    employee_id integer,
    benefit_consumed real,
    year_id integer,
    base_benefit_id integer,
    active boolean DEFAULT true,
    employee_type_id integer,
    status_id integer
);
ALTER TABLE public.employee_medical_record OWNER TO postgres;

CREATE SEQUENCE employee_medical_record_employee_medical_record_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.employee_medical_record_employee_medical_record_id_seq OWNER TO postgres;
ALTER SEQUENCE employee_medical_record_employee_medical_record_id_seq OWNED BY employee_medical_record.employee_medical_record_id;

CREATE TABLE employee_record (
    employee_record_id integer NOT NULL,
    employee_id integer,
    vl real,
    vl_lwop real,
    sl real,
    sl_lwop real,
    others real,
    active boolean DEFAULT true,
    academic_year_id integer,
    vl_base_id integer,
    sl_base_id integer,
    employee_type_id integer,
    status_id integer
);
ALTER TABLE public.employee_record OWNER TO postgres;

CREATE SEQUENCE employee_record_employee_record_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.employee_record_employee_record_id_seq OWNER TO postgres;
ALTER SEQUENCE employee_record_employee_record_id_seq OWNED BY employee_record.employee_record_id;

CREATE TABLE employee_type (
    employee_type_id integer NOT NULL,
    employee_type character varying
);
ALTER TABLE public.employee_type OWNER TO postgres;

CREATE SEQUENCE employee_type_employee_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.employee_type_employee_type_id_seq OWNER TO postgres;
ALTER SEQUENCE employee_type_employee_type_id_seq OWNED BY employee_type.employee_type_id;

CREATE TABLE employee_type_history (
    employee_type_history_id integer NOT NULL,
    employee_id integer,
    employee_type_id integer,
    type_start_date date,
    type_end_date date,
    active boolean DEFAULT true
);
ALTER TABLE public.employee_type_history OWNER TO postgres;

CREATE SEQUENCE employee_type_history_employee_type_history_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.employee_type_history_employee_type_history_id_seq OWNER TO postgres;
ALTER SEQUENCE employee_type_history_employee_type_history_id_seq OWNED BY employee_type_history.employee_type_history_id;

CREATE TABLE faculty_rank (
    faculty_rank_id integer NOT NULL,
    faculty_rank_description character varying
);
ALTER TABLE public.faculty_rank OWNER TO postgres;

CREATE TABLE faculty_rank_classification (
    faculty_rank_classification_id integer NOT NULL,
    faculty_rank_id integer,
    level_id integer,
    min_point_range_f integer,
    max_point_range_f integer,
    education_requirement_id integer,
    teaching_exp integer,
    managerial_exp integer,
    faculty_salary real
);
ALTER TABLE public.faculty_rank_classification OWNER TO postgres;

CREATE SEQUENCE faculty_rank_classification_faculty_rank_classification_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.faculty_rank_classification_faculty_rank_classification_id_seq OWNER TO postgres;
ALTER SEQUENCE faculty_rank_classification_faculty_rank_classification_id_seq OWNED BY faculty_rank_classification.faculty_rank_classification_id;

CREATE SEQUENCE faculty_rank_faculty_rank_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.faculty_rank_faculty_rank_id_seq OWNER TO postgres;
ALTER SEQUENCE faculty_rank_faculty_rank_id_seq OWNED BY faculty_rank.faculty_rank_id;

CREATE TABLE holiday (
    holiday_id integer NOT NULL,
    description character varying(100),
    date date,
    active boolean DEFAULT true,
    holiday_type_id integer
);
ALTER TABLE public.holiday OWNER TO postgres;

CREATE SEQUENCE holiday_holiday_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.holiday_holiday_id_seq OWNER TO postgres;
ALTER SEQUENCE holiday_holiday_id_seq OWNED BY holiday.holiday_id;

CREATE TABLE holiday_type (
    holiday_type_id integer NOT NULL,
    description character varying,
    active boolean DEFAULT true
);
ALTER TABLE public.holiday_type OWNER TO postgres;

CREATE SEQUENCE holiday_type_holiday_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.holiday_type_holiday_type_id_seq OWNER TO postgres;
ALTER SEQUENCE holiday_type_holiday_type_id_seq OWNED BY holiday_type.holiday_type_id;

CREATE TABLE job_position (
    job_position_id integer NOT NULL,
    "position" character varying,
    staff_job_grade_id integer
);
ALTER TABLE public.job_position OWNER TO postgres;

CREATE TABLE leave (
    leave_type_id integer NOT NULL,
    leave_start_date date,
    leave_end_date date,
    date_submitted date,
    date_decided date,
    status character varying(10),
    remarks character varying(200),
    leave_id integer NOT NULL,
    employee_id integer NOT NULL,
    duration real,
    base_leave_id integer,
    academic_year_id integer
);
ALTER TABLE public.leave OWNER TO postgres;

CREATE SEQUENCE leave_employee_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.leave_employee_id_seq OWNER TO postgres;
ALTER SEQUENCE leave_employee_id_seq OWNED BY leave.employee_id;

CREATE SEQUENCE leave_leave_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.leave_leave_id_seq OWNER TO postgres;
ALTER SEQUENCE leave_leave_id_seq OWNED BY leave.leave_id;

CREATE SEQUENCE leave_leave_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.leave_leave_type_id_seq OWNER TO postgres;
ALTER SEQUENCE leave_leave_type_id_seq OWNED BY leave.leave_type_id;

CREATE TABLE leave_type (
    leave_type_id integer NOT NULL,
    type character varying,
    active boolean DEFAULT true,
    description character varying
);
ALTER TABLE public.leave_type OWNER TO postgres;

CREATE SEQUENCE leave_type_leave_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.leave_type_leave_type_id_seq OWNER TO postgres;
ALTER SEQUENCE leave_type_leave_type_id_seq OWNED BY leave_type.leave_type_id;

CREATE TABLE level (
    level_id integer NOT NULL,
    level character varying
);
ALTER TABLE public.level OWNER TO postgres;

CREATE SEQUENCE level_level_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.level_level_id_seq OWNER TO postgres;
ALTER SEQUENCE level_level_id_seq OWNED BY level.level_id;

CREATE TABLE medical (
    medical_id integer NOT NULL,
    amount real,
    date_decided date,
    status character varying,
    employee_id integer,
    remarks character varying,
    base_benefit_id integer,
    year_id integer,
    date_submitted date
);
ALTER TABLE public.medical OWNER TO postgres;

CREATE SEQUENCE medical_medical_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.medical_medical_id_seq OWNER TO postgres;
ALTER SEQUENCE medical_medical_id_seq OWNED BY medical.medical_id;

CREATE TABLE medical_receipt (
    medical_receipt_id integer NOT NULL,
    receipt_date date,
    receipt_number character varying,
    receipt_amount real,
    medical_id integer,
    status character varying DEFAULT 'Pending'::character varying
);
ALTER TABLE public.medical_receipt OWNER TO postgres;

CREATE SEQUENCE medical_receipt_medical_receipt_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.medical_receipt_medical_receipt_id_seq OWNER TO postgres;
ALTER SEQUENCE medical_receipt_medical_receipt_id_seq OWNED BY medical_receipt.medical_receipt_id;

CREATE TABLE rank (
    rank_id integer NOT NULL,
    employee_id integer,
    total_rank_points integer,
    rank_position character varying,
    rank_active boolean DEFAULT true,
    rank_date_id integer,
    rank_salary real,
    educ_attain integer,
    work_exp integer,
    cert_passed integer,
    educ_multiplier real,
    work_multiplier real,
    cert_multiplier real
);
ALTER TABLE public.rank OWNER TO postgres;

CREATE TABLE rank_date (
    rank_date_id integer NOT NULL,
    rank_date date,
    active boolean DEFAULT true
);
ALTER TABLE public.rank_date OWNER TO postgres;

CREATE SEQUENCE rank_date_rank_date_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.rank_date_rank_date_id_seq OWNER TO postgres;
ALTER SEQUENCE rank_date_rank_date_id_seq OWNED BY rank_date.rank_date_id;

CREATE SEQUENCE rank_educ_attain_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.rank_educ_attain_seq OWNER TO postgres;
ALTER SEQUENCE rank_educ_attain_seq OWNED BY rank.educ_attain;

CREATE SEQUENCE rank_rank_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.rank_rank_id_seq OWNER TO postgres;
ALTER SEQUENCE rank_rank_id_seq OWNED BY rank.rank_id;

CREATE SEQUENCE school_year_school_year_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.school_year_school_year_id_seq OWNER TO postgres;
ALTER SEQUENCE school_year_school_year_id_seq OWNED BY academic_year.academic_year_id;

CREATE TABLE staff_job_grade (
    staff_job_grade_id integer NOT NULL,
    value integer,
    grade character varying,
    job_description character varying
);
ALTER TABLE public.staff_job_grade OWNER TO postgres;

CREATE SEQUENCE staff_job_grade_staff_job_grade_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.staff_job_grade_staff_job_grade_id_seq OWNER TO postgres;
ALTER SEQUENCE staff_job_grade_staff_job_grade_id_seq OWNED BY staff_job_grade.staff_job_grade_id;

CREATE SEQUENCE staff_position_staff_position_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.staff_position_staff_position_id_seq OWNER TO postgres;
ALTER SEQUENCE staff_position_staff_position_id_seq OWNED BY job_position.job_position_id;

CREATE TABLE staff_rank_classification (
    staff_rank_classification_id integer NOT NULL,
    staff_job_grade_id integer,
    level_id integer,
    min_point_range integer,
    max_point_range integer,
    staff_salary real
);
ALTER TABLE public.staff_rank_classification OWNER TO postgres;

CREATE SEQUENCE staff_rank_classification_staff_rank_classification_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.staff_rank_classification_staff_rank_classification_id_seq OWNER TO postgres;
ALTER SEQUENCE staff_rank_classification_staff_rank_classification_id_seq OWNED BY staff_rank_classification.staff_rank_classification_id;

CREATE TABLE status (
    status_id integer NOT NULL,
    employee_id integer,
    start_date date,
    active boolean DEFAULT true,
    employee_status character varying,
    end_date date
);
ALTER TABLE public.status OWNER TO postgres;

CREATE SEQUENCE status_status_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.status_status_id_seq OWNER TO postgres;
ALTER SEQUENCE status_status_id_seq OWNED BY status.status_id;

CREATE TABLE user_type (
    user_id integer NOT NULL,
    type character varying(20),
    description character varying(100)
);
ALTER TABLE public.user_type OWNER TO postgres;

CREATE SEQUENCE user_type_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.user_type_user_id_seq OWNER TO postgres;
ALTER SEQUENCE user_type_user_id_seq OWNED BY user_type.user_id;

CREATE TABLE weight_multiplier (
    weight_multiplier_id integer NOT NULL,
    criteria_id integer,
    employee_type_id integer,
    weight real
);
ALTER TABLE public.weight_multiplier OWNER TO postgres;

CREATE SEQUENCE weight_multiplier_weight_multiplier_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.weight_multiplier_weight_multiplier_id_seq OWNER TO postgres;
ALTER SEQUENCE weight_multiplier_weight_multiplier_id_seq OWNED BY weight_multiplier.weight_multiplier_id;

CREATE TABLE work (
    work_id integer NOT NULL,
    employee_id integer,
    employer character varying,
    work_duration integer,
    work_type_experience_id integer,
    previous_work_start_date date
);
ALTER TABLE public.work OWNER TO postgres;

CREATE TABLE work_experience (
    work_experience_id integer NOT NULL,
    employee_type_id integer,
    work_points integer,
    work_min_months integer,
    work_max_months integer,
    work_type_experience_id integer
);
ALTER TABLE public.work_experience OWNER TO postgres;

CREATE SEQUENCE work_experience_work_experience_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.work_experience_work_experience_id_seq OWNER TO postgres;
ALTER SEQUENCE work_experience_work_experience_id_seq OWNED BY work_experience.work_experience_id;

CREATE TABLE work_type_experience (
    work_type_experience_id integer NOT NULL,
    work_type character varying
);
ALTER TABLE public.work_type_experience OWNER TO postgres;

CREATE SEQUENCE work_type_experience_work_type_experience_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.work_type_experience_work_type_experience_id_seq OWNER TO postgres;
ALTER SEQUENCE work_type_experience_work_type_experience_id_seq OWNED BY work_type_experience.work_type_experience_id;

CREATE SEQUENCE work_work_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.work_work_id_seq OWNER TO postgres;
ALTER SEQUENCE work_work_id_seq OWNED BY work.work_id;

CREATE TABLE year (
    year_id integer NOT NULL,
    start_date date,
    end_date date,
    current_year integer,
    active boolean DEFAULT true
);
ALTER TABLE public.year OWNER TO postgres;

CREATE SEQUENCE year_year_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE public.year_year_id_seq OWNER TO postgres;
ALTER SEQUENCE year_year_id_seq OWNED BY year.year_id;

ALTER TABLE ONLY academic_year ALTER COLUMN academic_year_id SET DEFAULT nextval('school_year_school_year_id_seq'::regclass);

ALTER TABLE ONLY base_benefit ALTER COLUMN base_benefit_id SET DEFAULT nextval('base_benefit_base_benefit_id_seq'::regclass);

ALTER TABLE ONLY base_leave ALTER COLUMN base_leave_id SET DEFAULT nextval('base_leave_base_leave_id_seq'::regclass);

ALTER TABLE ONLY base_points ALTER COLUMN base_points_id SET DEFAULT nextval('base_points_base_points_id_seq'::regclass);

ALTER TABLE ONLY certification_board ALTER COLUMN certification_board_id SET DEFAULT nextval('certification_board_certification_board_id_seq'::regclass);

ALTER TABLE ONLY certification_board_acquired ALTER COLUMN certification_board_acquired_id SET DEFAULT nextval('certification_board_acquired_certification_board_acquired_i_seq'::regclass);

ALTER TABLE ONLY certification_board_detail ALTER COLUMN certification_board_detail_id SET DEFAULT nextval('certification_board_detail_certification_board_detail_id_seq'::regclass);

ALTER TABLE ONLY certification_board_type ALTER COLUMN certification_board_type_id SET DEFAULT nextval('certification_board_type_certification_board_type_id_seq'::regclass);

ALTER TABLE ONLY criteria ALTER COLUMN criteria_id SET DEFAULT nextval('criteria_criteria_id_seq'::regclass);

ALTER TABLE ONLY education ALTER COLUMN education_id SET DEFAULT nextval('education_education_id_seq'::regclass);

ALTER TABLE ONLY education_detail ALTER COLUMN education_detail_id SET DEFAULT nextval('education_detail_id_education_detail_id_seq'::regclass);

ALTER TABLE ONLY education_level ALTER COLUMN education_level_id SET DEFAULT nextval('education_level_education_level_id_seq'::regclass);

ALTER TABLE ONLY educational_attainment ALTER COLUMN educational_attainment_id SET DEFAULT nextval('educational_attainment_educational_attainment_id_seq'::regclass);

ALTER TABLE ONLY employee_information ALTER COLUMN employee_id SET DEFAULT nextval('employee_information_employee_id_seq'::regclass);

ALTER TABLE ONLY employee_medical_record ALTER COLUMN employee_medical_record_id SET DEFAULT nextval('employee_medical_record_employee_medical_record_id_seq'::regclass);

ALTER TABLE ONLY employee_record ALTER COLUMN employee_record_id SET DEFAULT nextval('employee_record_employee_record_id_seq'::regclass);

ALTER TABLE ONLY employee_type ALTER COLUMN employee_type_id SET DEFAULT nextval('employee_type_employee_type_id_seq'::regclass);

ALTER TABLE ONLY employee_type_history ALTER COLUMN employee_type_history_id SET DEFAULT nextval('employee_type_history_employee_type_history_id_seq'::regclass);

ALTER TABLE ONLY faculty_rank ALTER COLUMN faculty_rank_id SET DEFAULT nextval('faculty_rank_faculty_rank_id_seq'::regclass);

ALTER TABLE ONLY faculty_rank_classification ALTER COLUMN faculty_rank_classification_id SET DEFAULT nextval('faculty_rank_classification_faculty_rank_classification_id_seq'::regclass);

ALTER TABLE ONLY holiday ALTER COLUMN holiday_id SET DEFAULT nextval('holiday_holiday_id_seq'::regclass);

ALTER TABLE ONLY holiday_type ALTER COLUMN holiday_type_id SET DEFAULT nextval('holiday_type_holiday_type_id_seq'::regclass);

ALTER TABLE ONLY job_position ALTER COLUMN job_position_id SET DEFAULT nextval('staff_position_staff_position_id_seq'::regclass);

ALTER TABLE ONLY leave ALTER COLUMN leave_type_id SET DEFAULT nextval('leave_leave_type_id_seq'::regclass);

ALTER TABLE ONLY leave ALTER COLUMN leave_id SET DEFAULT nextval('leave_leave_id_seq'::regclass);

ALTER TABLE ONLY leave ALTER COLUMN employee_id SET DEFAULT nextval('leave_employee_id_seq'::regclass);

ALTER TABLE ONLY leave_type ALTER COLUMN leave_type_id SET DEFAULT nextval('leave_type_leave_type_id_seq'::regclass);

ALTER TABLE ONLY level ALTER COLUMN level_id SET DEFAULT nextval('level_level_id_seq'::regclass);

ALTER TABLE ONLY medical ALTER COLUMN medical_id SET DEFAULT nextval('medical_medical_id_seq'::regclass);


ALTER TABLE ONLY medical_receipt ALTER COLUMN medical_receipt_id SET DEFAULT nextval('medical_receipt_medical_receipt_id_seq'::regclass);

ALTER TABLE ONLY rank ALTER COLUMN rank_id SET DEFAULT nextval('rank_rank_id_seq'::regclass);

ALTER TABLE ONLY rank_date ALTER COLUMN rank_date_id SET DEFAULT nextval('rank_date_rank_date_id_seq'::regclass);

ALTER TABLE ONLY staff_job_grade ALTER COLUMN staff_job_grade_id SET DEFAULT nextval('staff_job_grade_staff_job_grade_id_seq'::regclass);

ALTER TABLE ONLY staff_rank_classification ALTER COLUMN staff_rank_classification_id SET DEFAULT nextval('staff_rank_classification_staff_rank_classification_id_seq'::regclass);

ALTER TABLE ONLY status ALTER COLUMN status_id SET DEFAULT nextval('status_status_id_seq'::regclass);

ALTER TABLE ONLY user_type ALTER COLUMN user_id SET DEFAULT nextval('user_type_user_id_seq'::regclass);

ALTER TABLE ONLY weight_multiplier ALTER COLUMN weight_multiplier_id SET DEFAULT nextval('weight_multiplier_weight_multiplier_id_seq'::regclass);

ALTER TABLE ONLY work ALTER COLUMN work_id SET DEFAULT nextval('work_work_id_seq'::regclass);

ALTER TABLE ONLY work_experience ALTER COLUMN work_experience_id SET DEFAULT nextval('work_experience_work_experience_id_seq'::regclass);

ALTER TABLE ONLY work_type_experience ALTER COLUMN work_type_experience_id SET DEFAULT nextval('work_type_experience_work_type_experience_id_seq'::regclass);

ALTER TABLE ONLY year ALTER COLUMN year_id SET DEFAULT nextval('year_year_id_seq'::regclass);

ALTER TABLE ONLY base_benefit
    ADD CONSTRAINT base_benefit_pkey PRIMARY KEY (base_benefit_id);

ALTER TABLE ONLY base_leave
    ADD CONSTRAINT base_leave_pkey PRIMARY KEY (base_leave_id);

ALTER TABLE ONLY base_points
    ADD CONSTRAINT base_points_pkey PRIMARY KEY (base_points_id);

ALTER TABLE ONLY certification_board_acquired
    ADD CONSTRAINT certification_board_acquired_pkey PRIMARY KEY (certification_board_acquired_id);

ALTER TABLE ONLY certification_board_detail
    ADD CONSTRAINT certification_board_detail_pkey PRIMARY KEY (certification_board_detail_id);

ALTER TABLE ONLY certification_board
    ADD CONSTRAINT certification_board_pkey PRIMARY KEY (certification_board_id);

ALTER TABLE ONLY certification_board_type
    ADD CONSTRAINT certification_board_type_pkey PRIMARY KEY (certification_board_type_id);

ALTER TABLE ONLY criteria
    ADD CONSTRAINT criteria_pkey PRIMARY KEY (criteria_id);

ALTER TABLE ONLY education_detail
    ADD CONSTRAINT education_detail_id_pkey PRIMARY KEY (education_detail_id);

ALTER TABLE ONLY education_level
    ADD CONSTRAINT education_level_pkey PRIMARY KEY (education_level_id);

ALTER TABLE ONLY education
    ADD CONSTRAINT education_pkey PRIMARY KEY (education_id);

ALTER TABLE ONLY educational_attainment
    ADD CONSTRAINT educational_attainment_pkey PRIMARY KEY (educational_attainment_id);

ALTER TABLE ONLY employee_information
    ADD CONSTRAINT employee_information_pkey PRIMARY KEY (employee_id);

ALTER TABLE ONLY employee_medical_record
    ADD CONSTRAINT employee_medical_record_pkey PRIMARY KEY (employee_medical_record_id);

ALTER TABLE ONLY employee_record
    ADD CONSTRAINT employee_record_pkey PRIMARY KEY (employee_record_id);

ALTER TABLE ONLY employee_type_history
    ADD CONSTRAINT employee_type_history_pkey PRIMARY KEY (employee_type_history_id);

ALTER TABLE ONLY employee_type
    ADD CONSTRAINT employee_type_pkey PRIMARY KEY (employee_type_id);

ALTER TABLE ONLY faculty_rank_classification
    ADD CONSTRAINT faculty_rank_classification_pkey PRIMARY KEY (faculty_rank_classification_id);

ALTER TABLE ONLY faculty_rank
    ADD CONSTRAINT faculty_rank_pkey PRIMARY KEY (faculty_rank_id);

ALTER TABLE ONLY holiday
    ADD CONSTRAINT holiday_pkey PRIMARY KEY (holiday_id);

ALTER TABLE ONLY holiday_type
    ADD CONSTRAINT holiday_type_pkey PRIMARY KEY (holiday_type_id);

ALTER TABLE ONLY leave
    ADD CONSTRAINT leave_pkey PRIMARY KEY (leave_id);

ALTER TABLE ONLY leave_type
    ADD CONSTRAINT leave_type_pkey PRIMARY KEY (leave_type_id);

ALTER TABLE ONLY level
    ADD CONSTRAINT level_pkey PRIMARY KEY (level_id);

ALTER TABLE ONLY medical
    ADD CONSTRAINT medical_pkey PRIMARY KEY (medical_id);

ALTER TABLE ONLY medical_receipt
    ADD CONSTRAINT medical_receipt_pkey PRIMARY KEY (medical_receipt_id);

ALTER TABLE ONLY rank_date
    ADD CONSTRAINT rank_date_pkey PRIMARY KEY (rank_date_id);

ALTER TABLE ONLY rank
    ADD CONSTRAINT rank_pkey PRIMARY KEY (rank_id);

ALTER TABLE ONLY academic_year
    ADD CONSTRAINT school_year_pkey PRIMARY KEY (academic_year_id);

ALTER TABLE ONLY staff_job_grade
    ADD CONSTRAINT staff_job_grade_pkey PRIMARY KEY (staff_job_grade_id);

ALTER TABLE ONLY job_position
    ADD CONSTRAINT staff_position_pkey PRIMARY KEY (job_position_id);

ALTER TABLE ONLY staff_rank_classification
    ADD CONSTRAINT staff_rank_classification_pkey PRIMARY KEY (staff_rank_classification_id);

ALTER TABLE ONLY status
    ADD CONSTRAINT status_pkey PRIMARY KEY (status_id);

ALTER TABLE ONLY user_type
    ADD CONSTRAINT user_type_pkey PRIMARY KEY (user_id);

ALTER TABLE ONLY weight_multiplier
    ADD CONSTRAINT weight_multiplier_pkey PRIMARY KEY (weight_multiplier_id);

ALTER TABLE ONLY work_experience
    ADD CONSTRAINT work_experience_pkey PRIMARY KEY (work_experience_id);

ALTER TABLE ONLY work
    ADD CONSTRAINT work_pkey PRIMARY KEY (work_id);

ALTER TABLE ONLY work_type_experience
    ADD CONSTRAINT work_type_experience_pkey PRIMARY KEY (work_type_experience_id);

ALTER TABLE ONLY year
    ADD CONSTRAINT year_pkey PRIMARY KEY (year_id);

ALTER TABLE ONLY base_leave
    ADD CONSTRAINT employee_type_id_base FOREIGN KEY (employee_type_id) REFERENCES employee_type(employee_type_id);

ALTER TABLE ONLY leave
    ADD CONSTRAINT fk_academic_year_leave FOREIGN KEY (academic_year_id) REFERENCES academic_year(academic_year_id) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY employee_medical_record
    ADD CONSTRAINT fk_base_benefit FOREIGN KEY (base_benefit_id) REFERENCES base_benefit(base_benefit_id);

ALTER TABLE ONLY medical
    ADD CONSTRAINT fk_base_benefit_id FOREIGN KEY (base_benefit_id) REFERENCES base_benefit(base_benefit_id);

ALTER TABLE ONLY leave
    ADD CONSTRAINT fk_base_leave_id FOREIGN KEY (base_leave_id) REFERENCES base_leave(base_leave_id);

ALTER TABLE ONLY certification_board
    ADD CONSTRAINT fk_certification_board_detail_id FOREIGN KEY (certification_board_detail_id) REFERENCES certification_board_detail(certification_board_detail_id);

ALTER TABLE ONLY certification_board_acquired
    ADD CONSTRAINT fk_certification_board_id_cert FOREIGN KEY (certification_board_id) REFERENCES certification_board(certification_board_id);

ALTER TABLE ONLY certification_board
    ADD CONSTRAINT fk_certification_board_type_id FOREIGN KEY (certification_board_type_id) REFERENCES certification_board_type(certification_board_type_id);

ALTER TABLE ONLY weight_multiplier
    ADD CONSTRAINT fk_criteria_id FOREIGN KEY (criteria_id) REFERENCES criteria(criteria_id);

ALTER TABLE ONLY base_points
    ADD CONSTRAINT fk_criteria_id_base FOREIGN KEY (criteria_id) REFERENCES criteria(criteria_id);

ALTER TABLE ONLY educational_attainment
    ADD CONSTRAINT fk_education_detail_id FOREIGN KEY (education_detail_id) REFERENCES education_detail(education_detail_id);

ALTER TABLE ONLY faculty_rank_classification
    ADD CONSTRAINT fk_education_level FOREIGN KEY (education_requirement_id) REFERENCES education_level(education_level_id);

ALTER TABLE ONLY educational_attainment
    ADD CONSTRAINT fk_education_level_id FOREIGN KEY (education_level_id) REFERENCES education_level(education_level_id);

ALTER TABLE ONLY education
    ADD CONSTRAINT fk_educational_attainment_id_education FOREIGN KEY (educational_attainment_id) REFERENCES educational_attainment(educational_attainment_id);

ALTER TABLE ONLY status
    ADD CONSTRAINT fk_employee_id FOREIGN KEY (employee_id) REFERENCES employee_information(employee_id) ON DELETE CASCADE;

ALTER TABLE ONLY leave
    ADD CONSTRAINT fk_employee_id FOREIGN KEY (employee_id) REFERENCES employee_information(employee_id) ON DELETE CASCADE;

ALTER TABLE ONLY employee_record
    ADD CONSTRAINT fk_employee_id FOREIGN KEY (employee_id) REFERENCES employee_information(employee_id) ON DELETE CASCADE;

ALTER TABLE ONLY employee_medical_record
    ADD CONSTRAINT fk_employee_id_benefit FOREIGN KEY (employee_id) REFERENCES employee_information(employee_id) ON DELETE CASCADE;

ALTER TABLE ONLY certification_board_acquired
    ADD CONSTRAINT fk_employee_id_cert FOREIGN KEY (employee_id) REFERENCES employee_information(employee_id) ON DELETE CASCADE;

ALTER TABLE ONLY education
    ADD CONSTRAINT fk_employee_id_education FOREIGN KEY (employee_id) REFERENCES employee_information(employee_id) ON DELETE CASCADE;

ALTER TABLE ONLY employee_type_history
    ADD CONSTRAINT fk_employee_id_history FOREIGN KEY (employee_id) REFERENCES employee_information(employee_id) ON DELETE CASCADE;

ALTER TABLE ONLY medical
    ADD CONSTRAINT fk_employee_id_medical FOREIGN KEY (employee_id) REFERENCES employee_information(employee_id) ON DELETE CASCADE;

ALTER TABLE ONLY rank
    ADD CONSTRAINT fk_employee_id_rank FOREIGN KEY (employee_id) REFERENCES employee_information(employee_id) ON DELETE CASCADE;

ALTER TABLE ONLY work
    ADD CONSTRAINT fk_employee_id_work FOREIGN KEY (employee_id) REFERENCES employee_information(employee_id) ON DELETE CASCADE;

ALTER TABLE ONLY employee_information
    ADD CONSTRAINT fk_employee_type_id FOREIGN KEY (employee_type_id) REFERENCES employee_type(employee_type_id);

ALTER TABLE ONLY base_benefit
    ADD CONSTRAINT fk_employee_type_id FOREIGN KEY (employee_type_id) REFERENCES employee_type(employee_type_id);

ALTER TABLE ONLY base_points
    ADD CONSTRAINT fk_employee_type_id_base FOREIGN KEY (employee_type_id) REFERENCES employee_type(employee_type_id);

ALTER TABLE ONLY certification_board
    ADD CONSTRAINT fk_employee_type_id_cert FOREIGN KEY (employee_type_id) REFERENCES employee_type(employee_type_id);

ALTER TABLE ONLY educational_attainment
    ADD CONSTRAINT fk_employee_type_id_education FOREIGN KEY (employee_type_id) REFERENCES employee_type(employee_type_id);

ALTER TABLE ONLY employee_type_history
    ADD CONSTRAINT fk_employee_type_id_history FOREIGN KEY (employee_type_id) REFERENCES employee_type(employee_type_id);

ALTER TABLE ONLY employee_medical_record
    ADD CONSTRAINT fk_employee_type_id_medical_record FOREIGN KEY (employee_type_id) REFERENCES employee_type(employee_type_id);

ALTER TABLE ONLY employee_record
    ADD CONSTRAINT fk_employee_type_id_record FOREIGN KEY (employee_type_id) REFERENCES employee_type(employee_type_id);

ALTER TABLE ONLY weight_multiplier
    ADD CONSTRAINT fk_employee_type_id_weight FOREIGN KEY (employee_type_id) REFERENCES employee_type(employee_type_id);

ALTER TABLE ONLY work_experience
    ADD CONSTRAINT fk_employee_type_id_work FOREIGN KEY (employee_type_id) REFERENCES employee_type(employee_type_id);

ALTER TABLE ONLY faculty_rank_classification
    ADD CONSTRAINT fk_faculty_rank FOREIGN KEY (faculty_rank_id) REFERENCES faculty_rank(faculty_rank_id);

ALTER TABLE ONLY holiday
    ADD CONSTRAINT fk_holiday_type_id FOREIGN KEY (holiday_type_id) REFERENCES holiday_type(holiday_type_id);
	
ALTER TABLE ONLY job_position
    ADD CONSTRAINT fk_job_grade FOREIGN KEY (staff_job_grade_id) REFERENCES staff_job_grade(staff_job_grade_id);

ALTER TABLE ONLY employee_information
    ADD CONSTRAINT fk_job_position_id FOREIGN KEY (job_position_id) REFERENCES job_position(job_position_id);

ALTER TABLE ONLY leave
    ADD CONSTRAINT fk_leave_type_id FOREIGN KEY (leave_type_id) REFERENCES leave_type(leave_type_id);

ALTER TABLE ONLY base_leave
    ADD CONSTRAINT fk_leave_type_id_base FOREIGN KEY (leave_type_id) REFERENCES leave_type(leave_type_id);

ALTER TABLE ONLY faculty_rank_classification
    ADD CONSTRAINT fk_level_id_faculty FOREIGN KEY (level_id) REFERENCES level(level_id);

ALTER TABLE ONLY staff_rank_classification
    ADD CONSTRAINT fk_level_id_staff FOREIGN KEY (level_id) REFERENCES level(level_id);

ALTER TABLE ONLY medical_receipt
    ADD CONSTRAINT fk_medical_id FOREIGN KEY (medical_id) REFERENCES medical(medical_id) ON UPDATE CASCADE ON DELETE CASCADE;
	
ALTER TABLE ONLY rank
    ADD CONSTRAINT fk_rank_date FOREIGN KEY (rank_date_id) REFERENCES rank_date(rank_date_id) ON DELETE CASCADE;

ALTER TABLE ONLY employee_record
    ADD CONSTRAINT fk_school_year_id FOREIGN KEY (academic_year_id) REFERENCES academic_year(academic_year_id) ON DELETE CASCADE;

ALTER TABLE ONLY staff_rank_classification
    ADD CONSTRAINT fk_staff_job_grade_id FOREIGN KEY (staff_job_grade_id) REFERENCES staff_job_grade(staff_job_grade_id);

ALTER TABLE ONLY employee_record
    ADD CONSTRAINT fk_status_id FOREIGN KEY (status_id) REFERENCES status(status_id);

ALTER TABLE ONLY employee_information
    ADD CONSTRAINT fk_user_type_id FOREIGN KEY (user_type_id) REFERENCES user_type(user_id);

ALTER TABLE ONLY work_experience
    ADD CONSTRAINT fk_work_type_experience_id FOREIGN KEY (work_type_experience_id) REFERENCES work_type_experience(work_type_experience_id);

ALTER TABLE ONLY work
    ADD CONSTRAINT fk_work_type_experience_id_work FOREIGN KEY (work_type_experience_id) REFERENCES work_type_experience(work_type_experience_id);

ALTER TABLE ONLY medical
    ADD CONSTRAINT fk_year_id FOREIGN KEY (year_id) REFERENCES year(year_id);

ALTER TABLE ONLY employee_medical_record
    ADD CONSTRAINT fk_year_id_benefit FOREIGN KEY (year_id) REFERENCES year(year_id) ON DELETE CASCADE;

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;
