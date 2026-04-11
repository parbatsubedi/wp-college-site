<?php
/**
 * Demo Data Seeder
 * Run this once to populate demo content for the college site.
 * Access via: wp-admin/tools.php?page=fusion-college-demo-data
 * Or run via WP-CLI: wp eval-file wp-content/themes/fusion-college/inc/demo-data-seeder.php
 *
 * All course data scraped directly from https://fusioncollege.edu.au/courses/ and each course page.
 */

if (!defined('ABSPATH')) {
    exit;
}

// Add admin menu for demo data
function fusion_college_add_demo_menu() {
    add_management_page(
        'Fusion College Demo Data',
        'Fusion College Demo Data',
        'manage_options',
        'fusion-college-demo-data',
        'fusion_college_demo_data_page'
    );
}
add_action('admin_menu', 'fusion_college_add_demo_menu');

function fusion_college_demo_data_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_POST['import_demo_data']) && wp_verify_nonce($_POST['fusion_college_demo_nonce'], 'fusion_college_import_demo')) {
        fusion_college_import_demo_data();
        echo '<div class="notice notice-success"><p>Demo data has been imported successfully!</p></div>';
    }
    ?>
    <div class="wrap">
        <h1>Fusion College Demo Data Importer</h1>
        <p>This will create demo courses, events, and pages for testing the theme.</p>
        <form method="post">
            <?php wp_nonce_field('fusion_college_import_demo', 'fusion_college_demo_nonce'); ?>
            <input type="submit" name="import_demo_data" class="button button-primary" value="Import Demo Data">
        </form>
    </div>
    <?php
}

function fusion_college_import_demo_data() {
    $pages = array(
        array(
            'post_title'   => 'Admissions',
            'post_name'    => 'admissions',
            'post_type'    => 'page',
            'post_status'  => 'publish',
            'post_content' => 'Admissions page - select a course to view details.',
        ),
        array(
            'post_title'   => 'Contact',
            'post_name'    => 'contact',
            'post_type'    => 'page',
            'post_status'  => 'publish',
            'post_content' => 'Contact us page with form.',
        ),
        array(
            'post_title'   => 'Courses',
            'post_name'    => 'courses',
            'post_type'    => 'page',
            'post_status'  => 'publish',
            'post_content' => 'Browse our courses.',
        ),
        array(
            'post_title'   => 'Events',
            'post_name'    => 'events',
            'post_type'    => 'page',
            'post_status'  => 'publish',
            'post_content' => 'Upcoming events and activities.',
        ),
        array(
            'post_title'   => 'About Us',
            'post_name'    => 'about-us',
            'post_type'    => 'page',
            'post_status'  => 'publish',
            'post_content' => 'Welcome to Fusion College of Technology - focused on providing quality education and training in a wide range of courses that transform our students to be job-ready.',
        ),
        array(
            'post_title'   => 'Student Info',
            'post_name'    => 'student-info',
            'post_type'    => 'page',
            'post_status'  => 'publish',
            'post_content' => 'Student information including entry requirements, student services, forms and policies.',
        ),
        array(
            'post_title'   => 'Apply',
            'post_name'    => 'apply',
            'post_type'    => 'page',
            'post_status'  => 'publish',
            'post_content' => 'Application for enrolment form.',
        ),
    );

    foreach ($pages as $page) {
        if (!get_page_by_path($page['post_name'])) {
            wp_insert_post($page);
        }
    }

    $courses = array(
        // Building and Construction Trades
        array(
            'post_title'   => 'CPC30220 Certificate III in Carpentry',
            'post_name'    => 'cpc30220-certificate-iii-in-carpentry',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<h2>About this course</h2>
<p>This qualification provides a trade outcome in carpentry, covering work in residential and commercial applications. It includes setting out, manufacturing, constructing, assembling, installing and repairing products made using timber and non-timber materials.</p>
<h3>Licensing, legislative, regulatory or certification considerations</h3>
<p>State and territory jurisdictions may have different licensing, legislative, regulatory or certification requirements. Relevant state and territory regulatory authorities should be consulted to confirm those requirements.</p>
<p>Completion of the general construction induction training program, specified in the Safe Work Australia model Code of Practice: Construction Work, is required by anyone carrying out construction work. Achievement of CPCWHS1001 Prepare to work safely in the construction industry meets this requirement.</p>
<h3>Who should apply for this course and why?</h3>
<p>International students who are:</p>
<ul>
<li>seeking to pursue or further a career in carpentry</li>
<li>seeking to enter a new industry sector</li>
<li>seeking a pathway to higher-level qualifications</li>
</ul>
<h3>Entry Requirements</h3>
<p>International Students must:</p>
<ul>
<li>be at least 18 years of age and have completed Year 12 or equivalent</li>
<li>have completed the unit CPCCWHS1001 Prepare to work safely in the construction industry</li>
<li>participate in a course entry interview to determine suitability for the course and student needs. The course entry interview will also assess whether students can use digital technologies</li>
<li>have an IELTS score of 6.0 (test results must be no more than 2 years old). English language competence can also be demonstrated through documented evidence of any of the following: Educated for 5 years in an English-speaking country; or successful completion of an English Placement Test.</li>
</ul>
<p>Note that other English language tests such as PTE and TOEFL can be accepted. Students are required to provide their results so that it can be confirmed they are equivalent to IELTS 6.0.</p>
<p>Student must bring their laptop or compatible devices for classroom use, as it is essential for accessing materials and completing coursework.</p>
<h3>Course Duration &amp; Delivery</h3>
<p>This qualification will be delivered over 52 weeks, including 40 weeks of training and assessment spread over 4 terms of 10 weeks each and 12 weeks of holidays.</p>
<p><strong>Course Delivery Mode:</strong> Face-to-Face – 13.5 hours/week, Supervised Study Session – 6.5 hours/week</p>
<p><strong>Course Delivery Site:</strong> Classroom: Suite 502, Level 5, 16 – 18 Wentworth Street Parramatta NSW 2150</p>',
            'post_excerpt' => 'This qualification provides a trade outcome in carpentry, covering work in residential and commercial applications.',
        ),
        array(
            'post_title'   => 'CPC30620 Certificate III in Painting and Decorating',
            'post_name'    => 'cpc30620-certificate-iii-in-painting-and-decorating',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<h2>About this course</h2>
<p>This qualification provides a trade outcome in painting and decorating for residential and commercial construction work.</p>
<p>Completion of the general construction induction training program, specified in the Safe Work Australia model Code of Practice: Construction Work, is required by anyone carrying out construction work. Achievement of CPCCWHS1001 Prepare to work safely in the construction industry meets this requirement.</p>
<h3>Who should apply for this course and why?</h3>
<p>International students who are:</p>
<ul>
<li>seeking to pursue or further a career in painting and decorating</li>
<li>seeking to enter a new industry sector</li>
<li>seeking a pathway to higher-level qualifications</li>
</ul>
<h3>Course Duration &amp; Delivery</h3>
<p>This qualification will be delivered over 52 weeks, including 40 weeks of training and assessment spread over 4 terms of 10 weeks each and 12 weeks of holidays.</p>
<p><strong>Course Delivery Mode:</strong> Face-to-Face – 13.5 hours/week, Supervised Study Session – 6.5 hours/week</p>
<p><strong>Course Delivery Site:</strong> Classroom: Suite 502, Level 5, 16 – 18 Wentworth Street Parramatta NSW 2150</p>',
            'post_excerpt' => 'This qualification provides a trade outcome in painting and decorating for residential and commercial construction work.',
        ),
        array(
            'post_title'   => 'CPC33020 Certificate III in Bricklaying and Blocklaying',
            'post_name'    => 'cpc33020-certificate-iii-in-bricklaying-and-blocklaying',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<h2>About this course</h2>
<p>This qualification reflects the trade qualified role of a bricklayer, blocklayer or paver who may have responsibility for undertaking heritage bricklaying, refractory bricklaying, bricklaying, blocklaying and paving work in residential, industrial and commercial contexts, in both existing and new constructions.</p>
<h3>Who should apply for this course and why?</h3>
<p>International students who are:</p>
<ul>
<li>seeking to pursue or further a career in bricklaying and blocklaying</li>
<li>seeking to enter a new industry sector</li>
<li>seeking a pathway to higher-level qualifications</li>
</ul>
<h3>Course Duration &amp; Delivery</h3>
<p>This qualification will be delivered over 52 weeks, including 40 weeks of training and assessment spread over 4 terms of 10 weeks each and 12 weeks of holidays.</p>
<p><strong>Course Delivery Mode:</strong> Face-to-Face – 13.5 hours/week, Supervised Study Session – 6.5 hours/week</p>
<p><strong>Course Delivery Site:</strong> Classroom: Suite 502, Level 5, 16 – 18 Wentworth Street Parramatta NSW 2150</p>',
            'post_excerpt' => 'This qualification reflects the trade qualified role of a bricklayer, blocklayer or paver.',
        ),
        array(
            'post_title'   => 'CPC31020 Certificate III in Solid Plastering',
            'post_name'    => 'cpc31020-certificate-iii-in-solid-plastering',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<h2>About this course</h2>
<p>This qualification provides a trade outcome in solid plastering for residential and commercial work. Solid plasterers apply plaster, cement and other mixtures to walls to create smooth or decorative finishes to interior walls and to render to exterior walls.</p>
<h3>Who should apply for this course and why?</h3>
<p>International students who are:</p>
<ul>
<li>seeking to pursue or further a career in solid plastering</li>
<li>seeking to enter a new industry sector</li>
<li>seeking a pathway to higher-level qualifications</li>
</ul>
<h3>Course Duration &amp; Delivery</h3>
<p>This qualification will be delivered over 52 weeks, including 40 weeks of training and assessment spread over 4 terms of 10 weeks each and 12 weeks of holidays.</p>
<p><strong>Course Delivery Mode:</strong> Face-to-Face – 13.5 hours/week, Supervised Study Session – 6.5 hours/week</p>
<p><strong>Course Delivery Site:</strong> Classroom: Suite 502, Level 5, 16 – 18 Wentworth Street Parramatta NSW 2150</p>',
            'post_excerpt' => 'This qualification provides a trade outcome in solid plastering for residential and commercial work.',
        ),
        array(
            'post_title'   => 'MSF30422 Certificate III in Glass and Glazing',
            'post_name'    => 'msf30422-certificate-iii-in-glass-and-glazing',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<h2>About this course</h2>
<p>This qualification reflects the role of individuals involved in manufacturing, processing, moving or installing various types of glass products. Job roles may be in glass processing, Glazing or designed Glazing in both residential and commercial operations.</p>
<h3>Who should apply for this course and why?</h3>
<p>International students who are:</p>
<ul>
<li>seeking to pursue or further a career in the glass and glazing industry</li>
<li>seeking to enter a new industry sector</li>
<li>seeking a pathway to higher-level qualifications</li>
</ul>
<h3>Course Duration &amp; Delivery</h3>
<p>This qualification will be delivered over 52 weeks, including 40 weeks of training and assessment spread over 4 terms of 10 weeks each and 12 weeks of holidays.</p>
<p><strong>Course Delivery Mode:</strong> Face-to-Face – 13.5 hours/week, Supervised Study Session – 6.5 hours/week</p>
<p><strong>Course Delivery Site:</strong> Classroom: Suite 502, Level 5, 16 – 18 Wentworth Street Parramatta NSW 2150</p>',
            'post_excerpt' => 'This qualification reflects the role of individuals involved in manufacturing, processing, moving or installing various types of glass products.',
        ),
        array(
            'post_title'   => 'CPC32620 Certificate III in Roof Plumbing',
            'post_name'    => 'cpc32620-certificate-iii-in-roof-plumbing',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<h2>About this course</h2>
<p>This qualification reflects the role of a person installing, maintaining and repairing flashings, metal roof and wall claddings and rainwater products such as gutters and downpipes, and other accessories on residential, industrial and commercial buildings.</p>
<h3>Who should apply for this course and why?</h3>
<p>International students who are:</p>
<ul>
<li>seeking to pursue or further a career in roof plumbing</li>
<li>seeking to enter a new industry sector</li>
<li>seeking a pathway to higher-level qualifications</li>
</ul>
<h3>Course Duration &amp; Delivery</h3>
<p>This qualification will be delivered over 52 weeks, including 40 weeks of training and assessment spread over 4 terms of 10 weeks each and 12 weeks of holidays.</p>
<p><strong>Course Delivery Mode:</strong> Face-to-Face – 13.5 hours/week, Supervised Study Session – 6.5 hours/week</p>
<p><strong>Course Delivery Site:</strong> Classroom: Suite 502, Level 5, 16 – 18 Wentworth Street Parramatta NSW 2150</p>',
            'post_excerpt' => 'This qualification reflects the role of a person installing, maintaining and repairing flashings, metal roof and wall claddings and rainwater products.',
        ),
        array(
            'post_title'   => 'CPC31220 Certificate III in Wall and Ceiling Lining',
            'post_name'    => 'cpc31220-certificate-iii-in-wall-and-ceiling-lining',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<h2>About this course</h2>
<p>This qualification provides a trade outcome in wall and ceiling lining for residential and commercial construction work. Wall and ceiling liners apply and fix linings for non-structural walls and ceilings.</p>
<h3>Who should apply for this course and why?</h3>
<p>International students who are:</p>
<ul>
<li>seeking to pursue or further a career in wall and ceiling lining</li>
<li>seeking to enter a new industry sector</li>
<li>seeking a pathway to higher-level qualifications</li>
</ul>
<h3>Course Duration &amp; Delivery</h3>
<p>This qualification will be delivered over 52 weeks, including 40 weeks of training and assessment spread over 4 terms of 10 weeks each and 12 weeks of holidays.</p>
<p><strong>Course Delivery Mode:</strong> Face-to-Face – 13.5 hours/week, Supervised Study Session – 6.5 hours/week</p>
<p><strong>Course Delivery Site:</strong> Classroom: Suite 502, Level 5, 16 – 18 Wentworth Street Parramatta NSW 2150</p>',
            'post_excerpt' => 'This qualification provides a trade outcome in wall and ceiling lining for residential and commercial construction work.',
        ),
        array(
            'post_title'   => 'CPC50220 Diploma of Building and Construction (Building)',
            'post_name'    => 'cpc50220-diploma-of-building-and-construction-building',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<h2>About this course</h2>
<p>This qualification reflects the role of building professionals who apply knowledge of structural principles, risk and financial management, estimating, preparing and administering building and construction contracts, selecting contractors, overseeing the work and its quality and managing construction work in building projects including residential and commercial.</p>
<h3>Who should apply for this course and why?</h3>
<p>International students who are:</p>
<ul>
<li>seeking to pursue or further a career in building and construction</li>
<li>seeking to enter a new industry sector</li>
<li>seeking a pathway to higher-level qualifications</li>
</ul>
<h3>Course Duration &amp; Delivery</h3>
<p>This qualification will be delivered over 104 weeks, including 80 weeks of training and assessment spread over 8 terms of 10 weeks each and 24 weeks of holidays.</p>
<p><strong>Course Delivery Mode:</strong> Face-to-Face – 13.5 hours/week, Supervised Study Session – 6.5 hours/week</p>
<p><strong>Course Delivery Site:</strong> Classroom: Suite 502, Level 5, 16 – 18 Wentworth Street Parramatta NSW 2150</p>',
            'post_excerpt' => 'This qualification reflects the role of building professionals who apply knowledge of structural principles, risk and financial management.',
        ),
        // Civil Construction Design
        array(
            'post_title'   => 'RII50520 Diploma of Civil Construction Design',
            'post_name'    => 'rii50520-diploma-of-civil-construction-design',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<h2>About this course</h2>
<p>This qualification reflects the role of individuals working as designers or design paraprofessionals who support professional engineers. They perform tasks involving a high level of autonomy and requiring the application of significant judgement in planning and determining the selection of equipment/roles/techniques for themselves and others.</p>
<h3>Who should apply for this course and why?</h3>
<p>International students who are:</p>
<ul>
<li>seeking to pursue or further a career in civil construction design</li>
<li>seeking to enter a new industry sector</li>
<li>seeking a pathway to higher-level qualifications</li>
</ul>
<h3>Course Duration &amp; Delivery</h3>
<p>This qualification will be delivered over 78 weeks, including 60 weeks of training and assessment spread over 6 terms of 10 weeks each and 18 weeks of holidays.</p>
<p><strong>Course Delivery Mode:</strong> Face-to-Face – 13.5 hours/week, Supervised Study Session – 6.5 hours/week</p>
<p><strong>Course Delivery Site:</strong> Classroom: Suite 502, Level 5, 16 – 18 Wentworth Street Parramatta NSW 2150</p>',
            'post_excerpt' => 'This qualification reflects the role of individuals working as designers or design paraprofessionals who support professional engineers.',
        ),
        array(
            'post_title'   => 'RII60520 Advanced Diploma of Civil Construction Design',
            'post_name'    => 'rii60520-advanced-diploma-of-civil-construction-design',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<h2>About this course</h2>
<p>This qualification reflects the role of an individual working as a senior civil works designer or a para-professional designer, who supports professional engineers. They perform tasks that are broad, specialised, complex and technical and include strategic areas and initiating activities.</p>
<h3>Who should apply for this course and why?</h3>
<p>International students who are:</p>
<ul>
<li>seeking to pursue or further a career in civil construction design</li>
<li>seeking to enter a new industry sector</li>
<li>seeking a pathway to higher-level qualifications</li>
</ul>
<h3>Course Duration &amp; Delivery</h3>
<p>This qualification will be delivered over 104 weeks, including 80 weeks of training and assessment spread over 8 terms of 10 weeks each and 24 weeks of holidays.</p>
<p><strong>Course Delivery Mode:</strong> Face-to-Face – 13.5 hours/week, Supervised Study Session – 6.5 hours/week</p>
<p><strong>Course Delivery Site:</strong> Classroom: Suite 502, Level 5, 16 – 18 Wentworth Street Parramatta NSW 2150</p>',
            'post_excerpt' => 'This qualification reflects the role of an individual working as a senior civil works designer or a para-professional designer.',
        ),
        // Information Technology
        array(
            'post_title'   => 'ICT50220 Diploma of Information Technology',
            'post_name'    => 'ict50220-diploma-of-information-technology',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<h2>About this course</h2>
<p>This qualification reflects the role of individuals in a variety of information and communications technology (ICT) roles who have established specialised skills in a technical ICT function.</p>
<p>Individuals in these roles carry out moderately complex tasks in specialist fields, working independently, as part of a team or leading deliverables with others.</p>
<h3>Who should apply for this course and why?</h3>
<p>International students who are:</p>
<ul>
<li>seeking to pursue or further a career in information technology</li>
<li>seeking to enter a new industry sector</li>
<li>seeking a pathway to higher-level qualifications</li>
</ul>
<h3>Course Duration &amp; Delivery</h3>
<p>This qualification will be delivered over 78 weeks, including 60 weeks of training and assessment spread over 6 terms of 10 weeks each and 18 weeks of holidays.</p>
<p><strong>Course Delivery Mode:</strong> Face-to-Face – 13.5 hours/week, Supervised Study Session – 6.5 hours/week</p>
<p><strong>Course Delivery Site:</strong> Classroom: Suite 502, Level 5, 16 – 18 Wentworth Street Parramatta NSW 2150</p>',
            'post_excerpt' => 'This qualification reflects the role of individuals in a variety of ICT roles who have established specialised skills in a technical ICT function.',
        ),
        array(
            'post_title'   => 'ICT60220 Advanced Diploma of Information Technology',
            'post_name'    => 'ict60220-advanced-diploma-of-information-technology',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<h2>About this course</h2>
<p>This qualification reflects the role of individuals in a variety of information and communications technology (ICT) roles who have significant experience in specialist technical skills, or managerial business and people management skills.</p>
<p>Individuals in these roles carry out complex tasks in a specialist field, working independently, leading a team or a strategic direction of a business.</p>
<h3>Who should apply for this course and why?</h3>
<p>International students who are:</p>
<ul>
<li>seeking to pursue or further a career in information technology</li>
<li>seeking to enter a new industry sector</li>
<li>seeking a pathway to higher-level qualifications</li>
</ul>
<h3>Course Duration &amp; Delivery</h3>
<p>This qualification will be delivered over 104 weeks, including 80 weeks of training and assessment spread over 8 terms of 10 weeks each and 24 weeks of holidays.</p>
<p><strong>Course Delivery Mode:</strong> Face-to-Face – 13.5 hours/week, Supervised Study Session – 6.5 hours/week</p>
<p><strong>Course Delivery Site:</strong> Classroom: Suite 502, Level 5, 16 – 18 Wentworth Street Parramatta NSW 2150</p>',
            'post_excerpt' => 'This qualification reflects the role of individuals in ICT roles who have significant experience in specialist technical or managerial skills.',
        ),
        // Business and Management
        array(
            'post_title'   => 'BSB50420 Diploma of Leadership and Management',
            'post_name'    => 'bsb50420-diploma-of-leadership-and-management',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<h2>About this course</h2>
<p>This qualification reflects the role of individuals who apply knowledge, practical skills and experience in leadership and management across a range of enterprise and industry contexts.</p>
<p>Individuals at this level display initiative and judgement in planning, organising, implementing, and monitoring their own workload and the workload of others.</p>
<h3>Who should apply for this course and why?</h3>
<p>International students who are:</p>
<ul>
<li>seeking to pursue or further a career in leadership and management</li>
<li>seeking to enter a new industry sector</li>
<li>seeking a pathway to higher-level qualifications</li>
</ul>
<h3>Course Duration &amp; Delivery</h3>
<p>This qualification will be delivered over 52 weeks, including 40 weeks of training and assessment spread over 4 terms of 10 weeks each and 12 weeks of holidays.</p>
<p><strong>Course Delivery Mode:</strong> Face-to-Face – 13.5 hours/week, Supervised Study Session – 6.5 hours/week</p>
<p><strong>Course Delivery Site:</strong> Classroom: Suite 502, Level 5, 16 – 18 Wentworth Street Parramatta NSW 2150</p>',
            'post_excerpt' => 'This qualification reflects the role of individuals who apply knowledge, practical skills and experience in leadership and management.',
        ),
        array(
            'post_title'   => 'BSB60420 Advanced Diploma of Leadership and Management',
            'post_name'    => 'bsb60420-advanced-diploma-of-leadership-and-management',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<h2>About this course</h2>
<p>This qualification reflects the role of individuals who apply specialised knowledge and skills, together with experience in leadership and management, across a range of enterprise and industry contexts.</p>
<p>Individuals at this level use initiative and judgement to plan and implement a range of leadership and management functions, with accountability for personal and team outcomes within broad parameters.</p>
<h3>Who should apply for this course and why?</h3>
<p>International students who are:</p>
<ul>
<li>seeking to pursue or further a career in leadership and management</li>
<li>seeking to enter a new industry sector</li>
<li>seeking a pathway to higher-level qualifications</li>
</ul>
<h3>Course Duration &amp; Delivery</h3>
<p>This qualification will be delivered over 65 weeks, including 50 weeks of training and assessment spread over 5 terms of 10 weeks each and 15 weeks of holidays.</p>
<p><strong>Course Delivery Mode:</strong> Face-to-Face – 13.5 hours/week, Supervised Study Session – 6.5 hours/week</p>
<p><strong>Course Delivery Site:</strong> Classroom: Suite 502, Level 5, 16 – 18 Wentworth Street Parramatta NSW 2150</p>',
            'post_excerpt' => 'This qualification reflects the role of individuals who apply specialised knowledge and skills in leadership and management.',
        ),
        array(
            'post_title'   => 'BSB80120 Graduate Diploma of Management (Learning)',
            'post_name'    => 'bsb80120-graduate-diploma-of-management-learning',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<h2>About this course</h2>
<p>This qualification reflects the role of individuals who apply highly specialised knowledge and skills in the field of organisational learning and capability development. Individuals in these roles generate and evaluate complex ideas. They also initiate, design, and execute major learning and development functions within an organisation.</p>
<h3>Who should apply for this course and why?</h3>
<p>International students who are:</p>
<ul>
<li>seeking to pursue or further a career in organisational learning and capability development</li>
<li>seeking a pathway to higher-level qualifications</li>
</ul>
<h3>Course Duration &amp; Delivery</h3>
<p>This qualification will be delivered over 104 weeks, including 80 weeks of training and assessment spread over 8 terms of 10 weeks each and 24 weeks of holidays.</p>
<p><strong>Course Delivery Mode:</strong> Face-to-Face – 13.5 hours/week, Supervised Study Session – 6.5 hours/week</p>
<p><strong>Course Delivery Site:</strong> Classroom: Suite 502, Level 5, 16 – 18 Wentworth Street Parramatta NSW 2150</p>',
            'post_excerpt' => 'This qualification reflects the role of individuals who apply highly specialised knowledge and skills in the field of organisational learning and capability development.',
        ),
        // Kitchen and Hospitality
        array(
            'post_title'   => 'SIT60322 Advanced Diploma in Hospitality Management',
            'post_name'    => 'sit60322-advanced-diploma-in-hospitality-management',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<h2>About this course</h2>
<p>This qualification reflects the role of highly skilled senior managers who use a broad range of hospitality skills combined with specialised managerial skills and substantial knowledge of industry to coordinate hospitality operations. They operate with significant autonomy and are responsible for making strategic business management decisions.</p>
<h3>Who should apply for this course and why?</h3>
<p>International students who are:</p>
<ul>
<li>seeking to pursue or further a career in the hospitality management field</li>
<li>seeking to enter a new industry sector</li>
<li>seeking a pathway to higher-level qualifications</li>
</ul>
<h3>Course Duration &amp; Delivery</h3>
<p>The qualification is delivered over 104 weeks comprising of eight (8) terms of 10 weeks each (80 weeks total) and holiday breaks amounting to 24 weeks.</p>
<p><strong>Course Delivery Mode:</strong> Face-to-Face – 13.5 hours/week, Supervised Study Session – 6.5 hours/week. Work Placement: minimum 200 hours.</p>
<p><strong>Course Delivery Site:</strong> Classroom: Suite 502, 16 – 18 Wentworth Street Parramatta NSW 2150. Kitchen: Suite 203, 118 Church Street, Parramatta NSW 2150</p>',
            'post_excerpt' => 'This qualification reflects the role of highly skilled senior managers who coordinate hospitality operations.',
        ),
        array(
            'post_title'   => 'SIT40521 Certificate IV in Kitchen Management',
            'post_name'    => 'sit40521-certificate-iv-in-kitchen-management',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<h2>About this course</h2>
<p>This qualification reflects the role of chefs and cooks who have a supervisory or team leading role in the kitchen. They operate independently or with limited guidance from others and use discretion to solve non-routine problems.</p>
<h3>Who should apply for this course and why?</h3>
<p>International students who are:</p>
<ul>
<li>seeking to pursue or further a career in kitchen management</li>
<li>seeking to enter a new industry sector</li>
<li>seeking a pathway to higher-level qualifications</li>
</ul>
<h3>Course Duration &amp; Delivery</h3>
<p>The qualification is delivered over 78 weeks comprising of six (6) terms of 10 weeks each (60 weeks total) and holiday breaks amounting to 18 weeks.</p>
<p><strong>Course Delivery Mode:</strong> Face-to-Face – 13.5 hours/week, Supervised Study Session – 6.5 hours/week. Work Placement: minimum 192 hours (48 food service periods).</p>
<p><strong>Course Delivery Site:</strong> Classroom: Suite 502, 16 – 18 Wentworth Street Parramatta NSW 2150. Kitchen: Suite 203, 118 Church Street, Parramatta NSW 2150</p>',
            'post_excerpt' => 'This qualification reflects the role of chefs and cooks who have a supervisory or team leading role in the kitchen.',
        ),
        array(
            'post_title'   => 'SIT50422 Diploma of Hospitality Management',
            'post_name'    => 'sit50422-diploma-of-hospitality-management',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<h2>About this course</h2>
<p>This qualification reflects the role of highly skilled senior operators who use a broad range of hospitality skills combined with managerial skills and sound knowledge of industry to coordinate hospitality operations. They operate independently, have responsibility for others and make a range of operational business decisions.</p>
<h3>Who should apply for this course and why?</h3>
<p>International students who are:</p>
<ul>
<li>seeking to pursue or further a career in hospitality management</li>
<li>seeking to enter a new industry sector</li>
<li>seeking a pathway to higher-level qualifications</li>
</ul>
<h3>Course Duration &amp; Delivery</h3>
<p>The qualification is delivered over 104 weeks comprising of eight (8) terms of 10 weeks each (80 weeks total) and holiday breaks amounting to 24 weeks.</p>
<p><strong>Course Delivery Mode:</strong> Face-to-Face – 13.5 hours/week, Supervised Study Session – 6.5 hours/week. Work Placement: minimum 16 hours.</p>
<p><strong>Course Delivery Site:</strong> Classroom: Suite 502, 16 – 18 Wentworth Street Parramatta NSW 2150. Kitchen: Suite 203, 118 Church Street, Parramatta NSW 2150</p>',
            'post_excerpt' => 'This qualification reflects the role of highly skilled senior operators who coordinate hospitality operations.',
        ),
        // Community and Health
        array(
            'post_title'   => 'CHC33021 Certificate III in Individual Support',
            'post_name'    => 'chc33021-certificate-iii-in-individual-support',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<h2>About this course</h2>
<p>This qualification reflects the role of individuals in the community, home or residential care setting who work under supervision and delegation as a part of a multi-disciplinary team, following an individualised plan to provide person-centred support to people who may require support due to ageing, disability or some other reason.</p>
<p>To achieve this qualification, the candidate must have completed at least 120 hours of work as detailed in the Assessment Requirements of the units of competency.</p>
<h3>Who should apply for this course and why?</h3>
<p>International students who are:</p>
<ul>
<li>seeking to pursue or further a career in supporting individuals in a community, home or residential care setting</li>
<li>seeking to enter a new industry sector</li>
<li>seeking a pathway to higher-level qualifications</li>
</ul>
<h3>Course Duration &amp; Delivery</h3>
<p>The qualification is delivered over 26 weeks comprising of two (2) terms of 11 weeks each (22 weeks total) and holiday breaks amounting to 4 weeks.</p>
<p><strong>Course Delivery Mode:</strong> Face-to-Face – 13.5 hours/week, Supervised Study Session – 6.5 hours/week. Work Placement: minimum 120 hours.</p>
<p><strong>Course Delivery Site:</strong> Classroom: Suite 502, 16 – 18 Wentworth Street Parramatta NSW 2150. Work Placement: Various workplace.</p>',
            'post_excerpt' => 'This qualification reflects the role of individuals providing person-centred support in community, home or residential care settings.',
        ),
        array(
            'post_title'   => 'CHC43315 Certificate IV in Mental Health',
            'post_name'    => 'chc43315-certificate-iv-in-mental-health',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<h2>About this course</h2>
<p>This qualification reflects the role of workers who provide self-directed recovery oriented support for people affected by mental illness and psychiatric disability. Work involves implementing community based programs and activities focusing on mental health, mental illness and psychiatric disability.</p>
<p>To achieve this qualification, the candidate must have completed at least 80 hours of work as detailed in the Assessment Requirements of units of competency.</p>
<h3>Who should apply for this course and why?</h3>
<p>International students who are:</p>
<ul>
<li>seeking to pursue or further a career in mental health</li>
<li>seeking to enter a new industry sector</li>
<li>seeking a pathway to higher-level qualifications</li>
</ul>
<h3>Course Duration &amp; Delivery</h3>
<p>The qualification is delivered over 52 weeks comprising of four (4) terms of 10 weeks each (40 weeks total) and holiday breaks amounting to 12 weeks.</p>
<p><strong>Course Delivery Mode:</strong> Face-to-Face – 13.5 hours/week, Supervised Study Session – 6.5 hours/week. Work Placement: minimum 80 hours.</p>
<p><strong>Course Delivery Site:</strong> Classroom: Suite 502, 16 – 18 Wentworth Street Parramatta NSW 2150. Work Placement: Various workplace.</p>',
            'post_excerpt' => 'This qualification reflects the role of workers who provide self-directed recovery oriented support for people affected by mental illness.',
        ),
        array(
            'post_title'   => 'CHC52025 Diploma of Community Services',
            'post_name'    => 'chc52021-diploma-of-community-services',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<h2>About this course</h2>
<p>This qualification reflects the role of community services workers involved in the delivery, management and coordination of person-centred services to individuals, groups, and communities.</p>
<p>To achieve this qualification, the candidate must have completed at least 100 hours of work as detailed in the Assessment Requirements of units of competency.</p>
<h3>Who should apply for this course and why?</h3>
<p>International students who are:</p>
<ul>
<li>seeking to pursue or further a career in community services</li>
<li>seeking to enter a new industry sector</li>
<li>seeking a pathway to higher-level qualifications</li>
</ul>
<h3>Course Duration &amp; Delivery</h3>
<p>This qualification will be delivered over 104 weeks, including 80 weeks of training and assessment spread over 8 terms of 10 weeks each and 24 weeks of holidays.</p>
<p><strong>Course Delivery Mode:</strong> Face-to-Face – 13.5 hours/week, Supervised Study Session – 6.5 hours/week. Work Placement: minimum 200 hours.</p>
<p><strong>Course Delivery Site:</strong> Classroom: Suite 502, 16 – 18 Wentworth Street Parramatta NSW 2150. Work Placement: Various workplace.</p>',
            'post_excerpt' => 'This qualification reflects the role of community services workers involved in the delivery, management and coordination of person-centred services.',
        ),
    );

    foreach ($courses as $course) {
        $existing = get_page_by_path($course['post_name'], OBJECT, 'course');
        if (!$existing) {
            $course_id = wp_insert_post($course);

            $course_meta = fusion_college_get_course_meta($course['post_name']);
            foreach ($course_meta as $key => $value) {
                update_post_meta($course_id, $key, $value);
            }
        }
    }

    // Course categories
    $categories = array(
        array('name' => 'Building and Construction Trades', 'slug' => 'building-trades'),
        array('name' => 'Civil Construction Design', 'slug' => 'civil-construction-design'),
        array('name' => 'Information Technology', 'slug' => 'information-technology'),
        array('name' => 'Business and Management', 'slug' => 'business-and-management'),
        array('name' => 'Kitchen and Hospitality', 'slug' => 'kitchen-and-hospitality'),
        array('name' => 'Community and Health', 'slug' => 'community-and-health'),
    );

    foreach ($categories as $cat) {
        if (!term_exists($cat['slug'], 'course_category')) {
            wp_insert_term($cat['name'], 'course_category', array('slug' => $cat['slug']));
        }
    }

    // Assign categories to courses
    $course_cat_map = array(
        'cpc30220-certificate-iii-in-carpentry'                    => 'building-trades',
        'cpc30620-certificate-iii-in-painting-and-decorating'      => 'building-trades',
        'cpc33020-certificate-iii-in-bricklaying-and-blocklaying'  => 'building-trades',
        'cpc31020-certificate-iii-in-solid-plastering'             => 'building-trades',
        'msf30422-certificate-iii-in-glass-and-glazing'            => 'building-trades',
        'cpc32620-certificate-iii-in-roof-plumbing'                => 'building-trades',
        'cpc31220-certificate-iii-in-wall-and-ceiling-lining'      => 'building-trades',
        'cpc50220-diploma-of-building-and-construction-building'   => 'building-trades',
        'rii50520-diploma-of-civil-construction-design'            => 'civil-construction-design',
        'rii60520-advanced-diploma-of-civil-construction-design'   => 'civil-construction-design',
        'ict50220-diploma-of-information-technology'               => 'information-technology',
        'ict60220-advanced-diploma-of-information-technology'      => 'information-technology',
        'bsb50420-diploma-of-leadership-and-management'            => 'business-and-management',
        'bsb60420-advanced-diploma-of-leadership-and-management'   => 'business-and-management',
        'bsb80120-graduate-diploma-of-management-learning'         => 'business-and-management',
        'sit60322-advanced-diploma-in-hospitality-management'      => 'kitchen-and-hospitality',
        'sit40521-certificate-iv-in-kitchen-management'            => 'kitchen-and-hospitality',
        'sit50422-diploma-of-hospitality-management'               => 'kitchen-and-hospitality',
        'chc33021-certificate-iii-in-individual-support'           => 'community-and-health',
        'chc43315-certificate-iv-in-mental-health'                 => 'community-and-health',
        'chc52021-diploma-of-community-services'                   => 'community-and-health',
    );

    foreach ($course_cat_map as $course_slug => $cat_slug) {
        $course = get_page_by_path($course_slug, OBJECT, 'course');
        if ($course) {
            $term = term_exists($cat_slug, 'course_category');
            if ($term) {
                wp_set_object_terms($course->ID, (int)$term['term_id'], 'course_category');
            }
        }
    }

    // Events
    $events = array(
        array(
            'post_title'   => 'Open Day 2026',
            'post_name'    => 'open-day-2026',
            'post_type'    => 'event',
            'post_status'  => 'publish',
            'post_content' => 'Join us for our annual Open Day! Tour our campus, meet trainers, and learn about our courses.',
            'post_excerpt' => 'Explore our campus and discover your future.',
        ),
        array(
            'post_title'   => 'Industry Networking Night',
            'post_name'    => 'industry-networking-night',
            'post_type'    => 'event',
            'post_status'  => 'publish',
            'post_content' => 'Connect with industry professionals and fellow students at our networking event.',
            'post_excerpt' => 'Build your professional network.',
        ),
        array(
            'post_title'   => 'Graduation Ceremony - June 2026',
            'post_name'    => 'graduation-ceremony-june-2026',
            'post_type'    => 'event',
            'post_status'  => 'publish',
            'post_content' => 'Celebrate your achievements at our graduation ceremony.',
            'post_excerpt' => 'Celebrate your academic achievements.',
        ),
        array(
            'post_title'   => 'Career Fair 2026',
            'post_name'    => 'career-fair-2026',
            'post_type'    => 'event',
            'post_status'  => 'publish',
            'post_content' => 'Meet employers from various industries and explore job opportunities.',
            'post_excerpt' => 'Connect with potential employers.',
        ),
    );

    $future_dates = array(
        date('Y-m-d', strtotime('+30 days')),
        date('Y-m-d', strtotime('+45 days')),
        date('Y-m-d', strtotime('+60 days')),
        date('Y-m-d', strtotime('+90 days')),
    );

    foreach ($events as $index => $event) {
        $existing = get_page_by_path($event['post_name'], OBJECT, 'event');
        if (!$existing) {
            $event_id = wp_insert_post($event);
            update_post_meta($event_id, '_event_start_date', $future_dates[$index]);
            update_post_meta($event_id, '_event_end_date', $future_dates[$index]);
            update_post_meta($event_id, '_event_location', 'Sydney Campus');
        }
    }

    // Event categories
    $event_categories = array(
        array('name' => 'Open Day', 'slug' => 'open-day'),
        array('name' => 'Networking', 'slug' => 'networking'),
        array('name' => 'Graduation', 'slug' => 'graduation'),
        array('name' => 'Career', 'slug' => 'career'),
    );

    foreach ($event_categories as $cat) {
        if (!term_exists($cat['slug'], 'event_category')) {
            wp_insert_term($cat['name'], 'event_category', array('slug' => $cat['slug']));
        }
    }

    flush_rewrite_rules();

    fusion_college_import_gallery_data();
}

function fusion_college_import_gallery_data() {
    $gallery_categories = array(
        'civil-construction-design' => array(
            'name' => 'Civil Construction Design',
            'images' => array(
                '/wp-content/themes/fusion-college/images/civil/civil.jpeg',
                '/wp-content/themes/fusion-college/images/civil/civil-2.jpeg',
                '/wp-content/themes/fusion-college/images/civil/civil3.jpeg',
                '/wp-content/themes/fusion-college/images/civil/civil6.jpeg',
            ),
        ),
        'kitchen-and-hospitality' => array(
            'name' => 'Kitchen and Hospitality',
            'images' => array(
                '/wp-content/themes/fusion-college/images/kitchen-management/kitchen-management.jpeg',
                '/wp-content/themes/fusion-college/images/kitchen-management/kitchen-management1.jpeg',
                '/wp-content/themes/fusion-college/images/kitchen-management/kitchen-management2.jpeg',
                '/wp-content/themes/fusion-college/images/kitchen-management/kitchen-management3.jpeg',
                '/wp-content/themes/fusion-college/images/kitchen-management/kitchen-management4.jpeg',
                '/wp-content/themes/fusion-college/images/kitchen-management/kitchen-management-5.jpeg',
            ),
        ),
    );

    foreach ($gallery_categories as $cat_slug => $cat_data) {
        $term = term_exists($cat_slug, 'gallery_category');
        if (!$term) {
            $term = wp_insert_term($cat_data['name'], 'gallery_category', array('slug' => $cat_slug));
        }

        foreach ($cat_data['images'] as $index => $image_url) {
            $post_name = $cat_slug . '-image-' . ($index + 1);
            $existing = get_page_by_path($post_name, OBJECT, 'gallery');
            if (!$existing) {
                $gallery_id = wp_insert_post(array(
                    'post_title' => $cat_data['name'] . ' Image ' . ($index + 1),
                    'post_name' => $post_name,
                    'post_type' => 'gallery',
                    'post_status' => 'publish',
                    'post_content' => $cat_data['name'] . ' gallery image ' . ($index + 1),
                ));

                if ($gallery_id && !is_wp_error($term)) {
                    wp_set_object_terms($gallery_id, (int)$term['term_id'], 'gallery_category');
                    update_post_meta($gallery_id, '_gallery_image_url', $image_url);
                }
            }
        }
    }
}

function fusion_college_get_course_meta($course_slug) {
    // Fusion College site info — verified from https://fusioncollege.edu.au
    $rto_id           = '46086';
    $cricos_provider  = '04189E';
    $abn              = '30 655 078 587';
    $address          = 'Suite 502, Level 5, 16-18 Wentworth Street, Parramatta NSW 2150';
    $standard_intake  = 'January, February, April, May, July, August, October, November';
    $standard_delivery = 'Face-to-Face – 13.5 hours/week, Supervised Study Session – 6.5 hours/week';

    $meta = array(

        // -------------------------------------------------------
        // BUILDING AND CONSTRUCTION TRADES
        // -------------------------------------------------------

        'cpc30220-certificate-iii-in-carpentry' => array(
            '_course_duration'        => '52',
            '_course_fee'             => '15000',
            '_course_material_fee'    => '2500',
            '_course_application_fee' => '250',
            '_course_cricos_code'     => '119953G',
            '_course_rto_code'        => $rto_id,
            '_course_abn'             => $abn,
            '_course_study_mode'      => 'Full-time',
            '_course_intake_months'   => $standard_intake,
            '_course_location'        => 'Sydney',
            '_course_location_address'=> $address,
            '_course_delivery'        => $standard_delivery,
            '_course_featured_image'  => '/wp-content/themes/fusion-college/images/civil/civil.jpeg',
        ),

        'cpc30620-certificate-iii-in-painting-and-decorating' => array(
            '_course_duration'        => '52',
            '_course_fee'             => '15000',
            '_course_material_fee'    => '2500',
            '_course_application_fee' => '250',
            '_course_cricos_code'     => '119954F',
            '_course_rto_code'        => $rto_id,
            '_course_abn'             => $abn,
            '_course_study_mode'      => 'Full-time',
            '_course_intake_months'   => $standard_intake,
            '_course_location'        => 'Sydney',
            '_course_location_address'=> $address,
            '_course_delivery'        => $standard_delivery,
            '_course_featured_image'  => 'https://fusioncollege.edu.au/wp-content/uploads/2026/02/Painting.jpg',
        ),

        'cpc33020-certificate-iii-in-bricklaying-and-blocklaying' => array(
            '_course_duration'        => '52',
            '_course_fee'             => '15000',
            '_course_material_fee'    => '2500',
            '_course_application_fee' => '250',
            '_course_cricos_code'     => '119962F',
            '_course_rto_code'        => $rto_id,
            '_course_abn'             => $abn,
            '_course_study_mode'      => 'Full-time',
            '_course_intake_months'   => $standard_intake,
            '_course_location'        => 'Sydney',
            '_course_location_address'=> $address,
            '_course_delivery'        => $standard_delivery,
            '_course_featured_image'  => 'https://fusioncollege.edu.au/wp-content/uploads/2026/02/FCT-builder-scaled.jpg',
        ),

        'cpc31020-certificate-iii-in-solid-plastering' => array(
            '_course_duration'        => '52',
            '_course_fee'             => '15000',
            '_course_material_fee'    => '2500',
            '_course_application_fee' => '250',
            '_course_cricos_code'     => '119955E',
            '_course_rto_code'        => $rto_id,
            '_course_abn'             => $abn,
            '_course_study_mode'      => 'Full-time',
            '_course_intake_months'   => $standard_intake,
            '_course_location'        => 'Sydney',
            '_course_location_address'=> $address,
            '_course_delivery'        => $standard_delivery,
            '_course_featured_image'  => 'https://fusioncollege.edu.au/wp-content/uploads/2026/02/1145.jpg',
        ),

        'msf30422-certificate-iii-in-glass-and-glazing' => array(
            '_course_duration'        => '52',
            '_course_fee'             => '15000',
            '_course_material_fee'    => '2500',
            '_course_application_fee' => '250',
            '_course_cricos_code'     => '119958B',
            '_course_rto_code'        => $rto_id,
            '_course_abn'             => $abn,
            '_course_study_mode'      => 'Full-time',
            '_course_intake_months'   => $standard_intake,
            '_course_location'        => 'Sydney',
            '_course_location_address'=> $address,
            '_course_delivery'        => $standard_delivery,
            '_course_featured_image'  => 'https://fusioncollege.edu.au/wp-content/uploads/2026/02/110406.jpg',
        ),

        'cpc32620-certificate-iii-in-roof-plumbing' => array(
            '_course_duration'        => '52',
            '_course_fee'             => '15000',
            '_course_material_fee'    => '2500',
            '_course_application_fee' => '250',
            '_course_cricos_code'     => '119957C',
            '_course_rto_code'        => $rto_id,
            '_course_abn'             => $abn,
            '_course_study_mode'      => 'Full-time',
            '_course_intake_months'   => $standard_intake,
            '_course_location'        => 'Sydney',
            '_course_location_address'=> $address,
            '_course_delivery'        => $standard_delivery,
            // Live site uses 2149343665.jpg for Roof Plumbing
            '_course_featured_image'  => 'https://fusioncollege.edu.au/wp-content/uploads/2026/02/2149343665.jpg',
        ),

        'cpc31220-certificate-iii-in-wall-and-ceiling-lining' => array(
            '_course_duration'        => '52',
            '_course_fee'             => '15000',
            '_course_material_fee'    => '2500',
            '_course_application_fee' => '250',
            '_course_cricos_code'     => '119956D',
            '_course_rto_code'        => $rto_id,
            '_course_abn'             => $abn,
            '_course_study_mode'      => 'Full-time',
            '_course_intake_months'   => $standard_intake,
            '_course_location'        => 'Sydney',
            '_course_location_address'=> $address,
            '_course_delivery'        => $standard_delivery,
            // Live site uses 1652.jpg for Wall and Ceiling Lining
            '_course_featured_image'  => 'https://fusioncollege.edu.au/wp-content/uploads/2026/02/1652.jpg',
        ),

        'cpc50220-diploma-of-building-and-construction-building' => array(
            '_course_duration'        => '104',
            '_course_fee'             => '15000',
            '_course_material_fee'    => '2500',
            '_course_application_fee' => '250',
            '_course_cricos_code'     => '119960H',
            '_course_rto_code'        => $rto_id,
            '_course_abn'             => $abn,
            '_course_study_mode'      => 'Full-time',
            '_course_intake_months'   => $standard_intake,
            '_course_location'        => 'Sydney',
            '_course_location_address'=> $address,
            '_course_delivery'        => $standard_delivery,
            '_course_featured_image'  => 'https://fusioncollege.edu.au/wp-content/uploads/2026/02/60510.jpg',
        ),

        // -------------------------------------------------------
        // CIVIL CONSTRUCTION DESIGN
        // -------------------------------------------------------

        'rii50520-diploma-of-civil-construction-design' => array(
            '_course_duration'        => '78',
            '_course_fee'             => '22500',
            '_course_material_fee'    => '2000',
            '_course_application_fee' => '250',
            '_course_cricos_code'     => '119961G',
            '_course_rto_code'        => $rto_id,
            '_course_abn'             => $abn,
            '_course_study_mode'      => 'Full-time',
            '_course_intake_months'   => $standard_intake,
            '_course_location'        => 'Sydney',
            '_course_location_address'=> $address,
            '_course_delivery'        => $standard_delivery,
            '_course_featured_image'  => '/wp-content/themes/fusion-college/images/civil/civil.jpeg',
        ),

        'rii60520-advanced-diploma-of-civil-construction-design' => array(
            '_course_duration'        => '104',
            '_course_fee'             => '30000',
            '_course_material_fee'    => '2000',
            '_course_application_fee' => '250',
            '_course_cricos_code'     => '115258G',
            '_course_rto_code'        => $rto_id,
            '_course_abn'             => $abn,
            '_course_study_mode'      => 'Full-time',
            '_course_intake_months'   => $standard_intake,
            '_course_location'        => 'Sydney',
            '_course_location_address'=> $address,
            '_course_delivery'        => $standard_delivery,
            '_course_featured_image'  => '/wp-content/themes/fusion-college/images/civil/civil-2.jpeg',
        ),

        // -------------------------------------------------------
        // INFORMATION TECHNOLOGY
        // -------------------------------------------------------

        'ict50220-diploma-of-information-technology' => array(
            '_course_duration'        => '78',
            '_course_fee'             => '22500',
            '_course_material_fee'    => '1000',
            '_course_application_fee' => '250',
            '_course_cricos_code'     => '113995A',
            '_course_rto_code'        => $rto_id,
            '_course_abn'             => $abn,
            '_course_study_mode'      => 'Full-time',
            '_course_intake_months'   => $standard_intake,
            '_course_location'        => 'Sydney',
            '_course_location_address'=> $address,
            '_course_delivery'        => $standard_delivery,
            '_course_featured_image'  => 'https://fusioncollege.edu.au/wp-content/uploads/2023/02/teammm-scaled.jpg',
        ),

        'ict60220-advanced-diploma-of-information-technology' => array(
            '_course_duration'        => '104',
            '_course_fee'             => '30000',
            '_course_material_fee'    => '2000',
            '_course_application_fee' => '250',
            '_course_cricos_code'     => '113996M',
            '_course_rto_code'        => $rto_id,
            '_course_abn'             => $abn,
            '_course_study_mode'      => 'Full-time',
            '_course_intake_months'   => $standard_intake,
            '_course_location'        => 'Sydney',
            '_course_location_address'=> $address,
            '_course_delivery'        => $standard_delivery,
            '_course_featured_image'  => 'https://fusioncollege.edu.au/wp-content/uploads/2023/02/s3.jpg',
        ),

        // -------------------------------------------------------
        // BUSINESS AND MANAGEMENT
        // -------------------------------------------------------

        'bsb50420-diploma-of-leadership-and-management' => array(
            '_course_duration'        => '52',
            '_course_fee'             => '15000',
            '_course_material_fee'    => '1000',
            '_course_application_fee' => '250',
            '_course_cricos_code'     => '113989K',
            '_course_rto_code'        => $rto_id,
            '_course_abn'             => $abn,
            '_course_study_mode'      => 'Full-time',
            '_course_intake_months'   => $standard_intake,
            '_course_location'        => 'Sydney',
            '_course_location_address'=> $address,
            '_course_delivery'        => $standard_delivery,
            '_course_featured_image'  => 'https://fusioncollege.edu.au/wp-content/uploads/2023/02/leadership-scaled.jpg',
        ),

        'bsb60420-advanced-diploma-of-leadership-and-management' => array(
            '_course_duration'        => '65',
            '_course_fee'             => '30000',
            '_course_material_fee'    => '2000',
            '_course_application_fee' => '250',
            '_course_cricos_code'     => '113990F',
            '_course_rto_code'        => $rto_id,
            '_course_abn'             => $abn,
            '_course_study_mode'      => 'Full-time',
            '_course_intake_months'   => $standard_intake,
            '_course_location'        => 'Sydney',
            '_course_location_address'=> $address,
            '_course_delivery'        => $standard_delivery,
            '_course_featured_image'  => 'https://fusioncollege.edu.au/wp-content/uploads/2023/02/slider-1.jpg',
        ),

        'bsb80120-graduate-diploma-of-management-learning' => array(
            '_course_duration'        => '104',
            '_course_fee'             => '32000',
            '_course_material_fee'    => '1000',
            '_course_application_fee' => '250',
            '_course_cricos_code'     => '115259F',
            '_course_rto_code'        => $rto_id,
            '_course_abn'             => $abn,
            '_course_study_mode'      => 'Full-time',
            '_course_intake_months'   => 'January, April, July, October',
            '_course_location'        => 'Sydney',
            '_course_location_address'=> $address,
            '_course_delivery'        => $standard_delivery,
            '_course_featured_image'  => 'https://fusioncollege.edu.au/wp-content/uploads/2024/04/Graduate-Diploma-1.jpg',
        ),

        // -------------------------------------------------------
        // KITCHEN AND HOSPITALITY
        // -------------------------------------------------------

        'sit60322-advanced-diploma-in-hospitality-management' => array(
            '_course_duration'        => '104',
            '_course_fee'             => '30000',
            '_course_material_fee'    => '2000',
            '_course_application_fee' => '250',
            '_course_cricos_code'     => '119959A',
            '_course_rto_code'        => $rto_id,
            '_course_abn'             => $abn,
            '_course_study_mode'      => 'Full-time',
            '_course_intake_months'   => $standard_intake,
            '_course_location'        => 'Sydney',
            '_course_location_address'=> 'Classroom: Suite 502, 16-18 Wentworth Street Parramatta NSW 2150 | Kitchen: Suite 203, 118 Church Street, Parramatta NSW 2150',
            '_course_delivery'        => $standard_delivery . ', Work Placement – 200 hours',
            '_course_work_placement'  => '200',
            '_course_featured_image'  => '/wp-content/themes/fusion-college/images/kitchen-management/kitchen-management.jpeg',
        ),

        'sit40521-certificate-iv-in-kitchen-management' => array(
            '_course_duration'        => '78',
            '_course_fee'             => '24000',
            '_course_material_fee'    => '3000',
            '_course_application_fee' => '250',
            '_course_cricos_code'     => '113997K',
            '_course_rto_code'        => $rto_id,
            '_course_abn'             => $abn,
            '_course_study_mode'      => 'Full-time',
            '_course_intake_months'   => $standard_intake,
            '_course_location'        => 'Sydney',
            '_course_location_address'=> 'Classroom: Suite 502, 16-18 Wentworth Street Parramatta NSW 2150 | Kitchen: Suite 203, 118 Church Street, Parramatta NSW 2150',
            '_course_delivery'        => $standard_delivery . ', Work Placement – 192 hours (48 food service periods)',
            '_course_work_placement'  => '192',
            '_course_featured_image'  => '/wp-content/themes/fusion-college/images/kitchen-management/kitchen-management1.jpeg',
        ),

        'sit50422-diploma-of-hospitality-management' => array(
            '_course_duration'        => '104',
            '_course_fee'             => '28800',
            '_course_material_fee'    => '1500',
            '_course_application_fee' => '250',
            '_course_cricos_code'     => '113998J',
            '_course_rto_code'        => $rto_id,
            '_course_abn'             => $abn,
            '_course_study_mode'      => 'Full-time',
            '_course_intake_months'   => $standard_intake,
            '_course_location'        => 'Sydney',
            '_course_location_address'=> 'Classroom: Suite 502, 16-18 Wentworth Street Parramatta NSW 2150 | Kitchen: Suite 203, 118 Church Street, Parramatta NSW 2150',
            '_course_delivery'        => $standard_delivery . ', Work Placement – 16 hours',
            '_course_work_placement'  => '16',
            '_course_featured_image'  => '/wp-content/themes/fusion-college/images/kitchen-management/kitchen-management2.jpeg',
        ),

        // -------------------------------------------------------
        // COMMUNITY AND HEALTH
        // -------------------------------------------------------

        'chc33021-certificate-iii-in-individual-support' => array(
            '_course_duration'        => '26',
            '_course_fee'             => '14400',
            '_course_material_fee'    => '1500',
            '_course_application_fee' => '250',
            '_course_cricos_code'     => '119952H',
            '_course_rto_code'        => $rto_id,
            '_course_abn'             => $abn,
            '_course_study_mode'      => 'Full-time',
            '_course_intake_months'   => $standard_intake,
            '_course_location'        => 'Sydney',
            '_course_location_address'=> 'Classroom: Suite 502, 16-18 Wentworth Street Parramatta NSW 2150 | Work Placement: Various workplace',
            '_course_delivery'        => $standard_delivery . ', Work Placement – 120 hours',
            '_course_work_placement'  => '120',
            '_course_featured_image'  => 'https://fusioncollege.edu.au/wp-content/uploads/2026/02/531786-2.jpg',
        ),

        'chc43315-certificate-iv-in-mental-health' => array(
            '_course_duration'        => '52',
            '_course_fee'             => '14400',
            '_course_material_fee'    => '1500',
            '_course_application_fee' => '250',
            '_course_cricos_code'     => '113991E',
            '_course_rto_code'        => $rto_id,
            '_course_abn'             => $abn,
            '_course_study_mode'      => 'Full-time',
            '_course_intake_months'   => $standard_intake,
            '_course_location'        => 'Sydney',
            '_course_location_address'=> 'Classroom: Suite 502, 16-18 Wentworth Street Parramatta NSW 2150 | Work Placement: Various workplace',
            '_course_delivery'        => $standard_delivery . ', Work Placement – minimum 80 hours',
            '_course_work_placement'  => '80',
            '_course_featured_image'  => 'https://fusioncollege.edu.au/wp-content/uploads/2023/02/slider-3.jpg',
        ),

        'chc52021-diploma-of-community-services' => array(
            '_course_duration'        => '104',
            '_course_fee'             => '28800',
            '_course_material_fee'    => '2000',
            '_course_application_fee' => '250',
            '_course_cricos_code'     => '118852J',
            '_course_rto_code'        => $rto_id,
            '_course_abn'             => $abn,
            '_course_study_mode'      => 'Full-time',
            '_course_intake_months'   => $standard_intake,
            '_course_location'        => 'Sydney',
            '_course_location_address'=> 'Classroom: Suite 502, 16-18 Wentworth Street Parramatta NSW 2150 | Work Placement: Various workplace',
            '_course_delivery'        => $standard_delivery . ', Work Placement – 200 hours',
            '_course_work_placement'  => '200',
            '_course_featured_image'  => 'https://fusioncollege.edu.au/wp-content/uploads/2023/02/p1.jpg',
        ),

    );

    return isset($meta[$course_slug]) ? $meta[$course_slug] : array(
        '_course_duration'        => '52',
        '_course_fee'             => '8000',
        '_course_cricos_code'     => $cricos_provider,
        '_course_rto_code'        => $rto_id,
        '_course_abn'             => $abn,
        '_course_study_mode'      => 'Full-time',
        '_course_intake_months'   => $standard_intake,
        '_course_location'        => 'Sydney',
        '_course_location_address'=> $address,
    );
}

// Auto-run on theme activation
function fusion_college_auto_import_demo() {
    if (!get_option('fusion_college_demo_imported')) {
        fusion_college_import_demo_data();
        update_option('fusion_college_demo_imported', true);
    }
}
add_action('after_switch_theme', 'fusion_college_auto_import_demo');