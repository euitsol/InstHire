<?php

namespace Database\Seeders;

use App\Models\JobPost;
use App\Models\Institute;
use App\Models\Employee;
use App\Models\JobCategory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JobPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks to allow truncating
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear existing job posts
        JobPost::truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Company names
        $companies = [
            'TechNova Solutions', 'DataSphere Inc.', 'CloudPeak Technologies',
            'Quantum Innovations', 'Synergy Systems', 'Digital Dynamics',
            'FutureTech Labs', 'Horizon Software', 'Nexus Enterprises',
            'Vertex AI', 'Pinnacle Solutions', 'Elevate Digital',
            'Insight Analytics', 'Fusion Technologies', 'Apex Systems',
            'BlueWave Computing', 'RedShift Data', 'GreenLeaf Tech',
            'SilverLine Solutions', 'Golden Gate Software'
        ];

        // Job locations
        $locations = [
            'Dhaka, Bangladesh', 'Chittagong, Bangladesh', 'Sylhet, Bangladesh',
            'Rajshahi, Bangladesh', 'Khulna, Bangladesh', 'Barisal, Bangladesh',
            'Remote', 'Hybrid - Dhaka', 'Hybrid - Chittagong', 'Gulshan, Dhaka',
            'Banani, Dhaka', 'Dhanmondi, Dhaka', 'Uttara, Dhaka', 'Mirpur, Dhaka'
        ];

        // Job titles by category
        $jobTitlesByCategory = [
            1 => [ // Information Technology
                'IT Support Specialist', 'Network Administrator', 'Systems Analyst',
                'IT Project Manager', 'Cybersecurity Analyst'
            ],
            2 => [ // Software Development
                'Senior Software Engineer', 'Java Developer', 'C# Developer',
                'Mobile App Developer', 'Software Development Manager'
            ],
            3 => [ // Data Science & Analytics
                'Data Scientist', 'Business Intelligence Analyst', 'Data Engineer',
                'Machine Learning Engineer', 'Analytics Manager'
            ],
            4 => [ // Web Development
                'Full Stack Developer', 'Frontend Developer', 'Backend Developer',
                'WordPress Developer', 'PHP Developer'
            ],
            5 => [ // UI/UX Design
                'UI/UX Designer', 'Product Designer', 'Interaction Designer',
                'Visual Designer', 'UX Researcher'
            ],
            6 => [ // Marketing & Communications
                'Digital Marketing Specialist', 'Content Writer', 'SEO Specialist',
                'Social Media Manager', 'Marketing Coordinator'
            ],
            7 => [ // Finance & Accounting
                'Financial Analyst', 'Accountant', 'Finance Manager',
                'Accounts Payable Specialist', 'Tax Consultant'
            ],
            8 => [ // Human Resources
                'HR Manager', 'Recruitment Specialist', 'HR Coordinator',
                'Training and Development Specialist', 'Compensation Analyst'
            ],
            9 => [ // Sales & Business Development
                'Sales Representative', 'Business Development Manager', 'Account Executive',
                'Sales Manager', 'Customer Success Manager'
            ],
            10 => [ // Engineering
                'Mechanical Engineer', 'Civil Engineer', 'Electrical Engineer',
                'Chemical Engineer', 'Structural Engineer'
            ],
            11 => [ // Healthcare & Medical
                'Medical Officer', 'Nurse', 'Pharmacist',
                'Medical Technologist', 'Healthcare Administrator'
            ],
            12 => [ // Education & Training
                'Teacher', 'Trainer', 'Curriculum Developer',
                'Education Coordinator', 'Academic Counselor'
            ],
        ];

        // Job responsibilities by category
        $jobResponsibilitiesByCategory = [
            1 => "- Provide technical support to end-users for hardware and software issues
- Configure and maintain computer systems and networks
- Install and configure software and hardware
- Troubleshoot system and network problems
- Ensure security of data, network access, and backup systems",

            2 => "- Design, develop, and maintain software applications
- Write clean, scalable, and efficient code
- Collaborate with cross-functional teams
- Debug and fix software issues
- Participate in code reviews and documentation",

            3 => "- Analyze complex data sets to identify patterns and insights
- Build predictive models using machine learning techniques
- Create data visualizations and dashboards
- Develop data pipelines and ETL processes
- Present findings to stakeholders and make recommendations",

            4 => "- Develop and maintain web applications
- Write clean, maintainable, and efficient code
- Collaborate with designers to implement user interfaces
- Optimize applications for maximum speed and scalability
- Ensure cross-browser compatibility and responsive design",

            5 => "- Create user-centered designs by understanding business requirements
- Develop UI mockups and prototypes
- Conduct user research and testing
- Create wireframes, storyboards, user flows, and process flows
- Collaborate with developers for implementation",

            6 => "- Develop and implement marketing strategies
- Create content for various channels
- Manage social media accounts and campaigns
- Analyze marketing metrics and adjust strategies accordingly
- Coordinate with other teams for marketing initiatives",

            7 => "- Prepare financial reports and forecasts
- Analyze financial data and trends
- Manage budgeting and financial planning
- Ensure compliance with financial regulations
- Support decision-making with financial analysis",

            8 => "- Manage recruitment and onboarding processes
- Develop and implement HR policies and procedures
- Handle employee relations and conflict resolution
- Coordinate training and development programs
- Maintain HR systems and employee records",

            9 => "- Identify and pursue new business opportunities
- Build and maintain relationships with clients
- Meet or exceed sales targets
- Prepare and deliver sales presentations
- Negotiate contracts and close deals",

            10 => "- Design and develop engineering solutions
- Conduct engineering calculations and analysis
- Create technical drawings and specifications
- Ensure compliance with engineering standards
- Collaborate with cross-functional teams",

            11 => "- Provide medical care to patients
- Maintain medical records and documentation
- Collaborate with healthcare teams
- Follow medical protocols and procedures
- Stay updated with medical advancements",

            12 => "- Develop and deliver educational content
- Assess student progress and provide feedback
- Create engaging learning materials
- Adapt teaching methods to different learning styles
- Stay updated with educational trends and technologies",
        ];

        // Educational requirements by category
        $educationalRequirementsByCategory = [
            1 => "- Bachelor's degree in Computer Science, Information Technology, or related field
- Relevant IT certifications (CompTIA A+, Network+, MCSA, etc.) are a plus",

            2 => "- Bachelor's or Master's degree in Computer Science, Software Engineering, or related field
- Strong knowledge of software development principles and best practices",

            3 => "- Master's or PhD in Data Science, Statistics, Computer Science, or related field
- Strong mathematical and statistical background",

            4 => "- Bachelor's degree in Computer Science, Web Development, or related field
- Portfolio demonstrating web development projects",

            5 => "- Bachelor's degree in Design, HCI, or related field
- Portfolio demonstrating UI/UX design skills and projects",

            6 => "- Bachelor's degree in Marketing, Communications, or related field
- Digital marketing certifications are a plus",

            7 => "- Bachelor's degree in Finance, Accounting, or related field
- Professional certifications (CPA, CFA, etc.) are a plus",

            8 => "- Bachelor's degree in Human Resources, Business Administration, or related field
- HR certifications (SHRM, HRCI, etc.) are a plus",

            9 => "- Bachelor's degree in Business, Marketing, or related field
- Proven track record in sales or business development",

            10 => "- Bachelor's or Master's degree in relevant Engineering discipline
- Professional engineering license may be required",

            11 => "- Medical degree, Nursing degree, or relevant healthcare qualification
- Professional healthcare license as required by role",

            12 => "- Bachelor's or Master's degree in Education or relevant subject area
- Teaching certification or license may be required",
        ];

        // Experience requirements by category
        $experienceRequirementsByCategory = [
            1 => "- 2+ years of experience in IT support or related role
- Experience with Windows and Linux operating systems
- Knowledge of networking concepts and troubleshooting",

            2 => "- 3+ years of software development experience
- Proficiency in relevant programming languages
- Experience with software development lifecycle",

            3 => "- 3+ years of experience in data science or analytics
- Proficiency in Python, R, or similar languages
- Experience with machine learning frameworks and big data technologies",

            4 => "- 2+ years of web development experience
- Proficiency in HTML, CSS, JavaScript, and relevant frameworks
- Experience with responsive design and cross-browser compatibility",

            5 => "- 2+ years of UI/UX design experience
- Proficiency in design tools (Figma, Adobe XD, Sketch, etc.)
- Experience with user research and usability testing",

            6 => "- 2+ years of marketing or communications experience
- Experience with digital marketing platforms and analytics
- Content creation and campaign management experience",

            7 => "- 3+ years of finance or accounting experience
- Experience with financial software and systems
- Knowledge of financial regulations and reporting standards",

            8 => "- 3+ years of HR experience
- Experience with HR systems and processes
- Knowledge of labor laws and regulations",

            9 => "- 3+ years of sales or business development experience
- Track record of meeting or exceeding sales targets
- Experience with CRM systems and sales methodologies",

            10 => "- 3+ years of engineering experience
- Experience with relevant engineering software and tools
- Project management experience is a plus",

            11 => "- 2+ years of healthcare experience
- Experience in relevant medical specialties
- Knowledge of healthcare protocols and procedures",

            12 => "- 2+ years of teaching or training experience
- Experience developing curriculum or learning materials
- Knowledge of educational methodologies and assessment",
        ];

        // Benefits
        $benefits = [
            "- Competitive salary package
- Health insurance coverage
- Annual performance bonus
- Professional development opportunities
- Flexible working hours",

            "- Attractive salary and benefits
- Medical and life insurance
- Retirement benefits
- Paid time off and holidays
- Career advancement opportunities",

            "- Comprehensive health benefits
- Performance-based bonuses
- Professional training and certification
- Team building activities
- Modern office environment",

            "- Competitive compensation package
- Health and wellness programs
- Skill development opportunities
- Work-life balance initiatives
- Employee recognition programs",

            "- Attractive salary package
- Medical coverage for employee and family
- Annual leave and sick leave
- Professional growth opportunities
- Collaborative work environment"
        ];

        // Get valid IDs
        $instituteIds = Institute::pluck('id')->toArray();
        $employeeIds = Employee::pluck('id')->toArray();
        $categoryIds = JobCategory::pluck('id')->toArray();

        // Create 50 job posts
        $jobPosts = [];

        for ($i = 0; $i < 50; $i++) {
            // Random visibility logic
            $visibility = rand(0, 1);
            $instituteId = $visibility === JobPost::VISIBLE_INSTITUTE 
                ? $instituteIds[array_rand($instituteIds)] 
                : null;

            // Random job type logic
            $type = rand(0, 1);
            $employeeId = $type === JobPost::TYPE_SELF
                ? $employeeIds[array_rand($employeeIds)]
                : null;
            
            $applicationUrl = $type === JobPost::TYPE_EXTERNAL
                ? 'https://careerportal.com/jobs/'.Str::random(10)
                : null;

            // Salary logic
            $salaryType = rand(1, 3);
            $salary = $salaryType === JobPost::SALARY_NEGOTIABLE 
                ? null 
                : rand(30000, 150000) * ($salaryType === 2 ? 12 : 1);

            $jobPosts[] = [
                'title' => $jobTitlesByCategory[array_rand($jobTitlesByCategory)][array_rand($jobTitlesByCategory[array_rand($jobTitlesByCategory)])],
                'company_name' => $companies[array_rand($companies)],
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'visibility' => $visibility,
                'institute_id' => $instituteId,
                'type' => $type,
                'employee_id' => $employeeId,
                'application_url' => $applicationUrl,
                'email' => 'careers@'.Str::random(8).'.com',
                'job_type' => rand(1, 5),
                'salary' => $salary,
                'salary_type' => $salaryType,
                'deadline' => now()->addDays(rand(7, 30)),
                'vacancy' => rand(1, 10),
                'company_address' => $locations[array_rand($locations)].', Bangladesh',
                'job_responsibility' => $jobResponsibilitiesByCategory[array_rand($jobResponsibilitiesByCategory)],
                'educational_requirement' => $educationalRequirementsByCategory[array_rand($educationalRequirementsByCategory)],
                'professional_requirement' => 'Professional certifications relevant to the role are preferred.',
                'experience_requirement' => $experienceRequirementsByCategory[array_rand($experienceRequirementsByCategory)],
                'age_requirement' => 'Minimum 21 years',
                'job_location' => $locations[array_rand($locations)],
                'other_benefits' => $benefits[array_rand($benefits)],
                'special_instractions' => 'Please submit your updated resume and a cover letter explaining why you are a good fit for this role.',
                'status' => JobPost::STATUS_ACCEPTED,
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now(),
            ];
        }

        // Shuffle job posts to mix them up
        shuffle($jobPosts);

        // Insert job posts
        foreach ($jobPosts as $jobPost) {
            JobPost::create($jobPost);
        }
    }
}
