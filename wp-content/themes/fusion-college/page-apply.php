<?php
get_header();
$page = get_queried_object();
$courses = get_posts(array('post_type' => 'course', 'posts_per_page' => -1, 'post_status' => 'publish'));
?>
<section class="page-banner" style="background-image: url('<?php echo get_theme_mod('banner_image', get_template_directory_uri() . '/images/banner.jpg'); ?>')">
    <div class="banner-overlay"></div>
    <div class="container">
        <div class="banner-content">
            <h1>Apply Now</h1>
            <p>Start your journey with Fusion College of Technology</p>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="apply-form-wrapper">
            <div class="apply-intro">
                <h2>Application for Enrolment</h2>
                <p>Please fill out the form below to apply for your desired course. Our team will review your application and contact you within 2-3 business days.</p>
            </div>

            <form id="applyForm" class="apply-form">
                <?php wp_nonce_field('fusion-college-nonce', 'nonce'); ?>
                
                <h3 class="form-section-title">Personal Information</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">First Name *</label>
                        <input type="text" id="first_name" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name *</label>
                        <input type="text" id="last_name" name="last_name" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth *</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" required>
                    </div>
                    <div class="form-group">
                        <label for="country">Country *</label>
                        <select id="country" name="country" required>
                            <option value="">Select Country</option>
                            <option value="Australia">Australia</option>
                            <option value="India">India</option>
                            <option value="China">China</option>
                            <option value="Vietnam">Vietnam</option>
                            <option value="South Korea">South Korea</option>
                            <option value="Japan">Japan</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="address">Address *</label>
                    <input type="text" id="address" name="address" required>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="city">City *</label>
                        <input type="text" id="city" name="city" required>
                    </div>
                    <div class="form-group">
                        <label for="state">State/Province *</label>
                        <input type="text" id="state" name="state" required>
                    </div>
                    <div class="form-group">
                        <label for="zip_code">Zip/Postal Code *</label>
                        <input type="text" id="zip_code" name="zip_code" required>
                    </div>
                </div>
                
                <h3 class="form-section-title">Course Selection</h3>
                <div class="form-group">
                    <label for="course_id">Select Course *</label>
                    <select id="course_id" name="course_id" required>
                        <option value="">Select a Course</option>
                        <?php foreach ($courses as $course): ?>
                        <option value="<?php echo esc_attr($course->ID); ?>"><?php echo esc_html($course->post_title); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <h3 class="form-section-title">Additional Information</h3>
                <div class="form-group">
                    <label for="message">Message (Optional)</label>
                    <textarea id="message" name="message" rows="4" placeholder="Any additional information you'd like to share..."></textarea>
                </div>
                
                <div class="form-submit">
                    <button type="submit" class="btn btn-primary">Submit Application</button>
                </div>
                
                <div id="applyFormMessage" class="form-message"></div>
            </form>
        </div>
    </div>
</section>

<script>
jQuery(document).ready(function($) {
    $('#applyForm').on('submit', function(e) {
        e.preventDefault();
        
        var $btn = $(this).find('button[type="submit"]');
        $btn.prop('disabled', true).text('Submitting...');
        
        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: $(this).serialize() + '&action=fusion_college_apply_form',
            success: function(response) {
                if (response.success) {
                    $('#applyForm')[0].reset();
                    $('#applyFormMessage').html('<div class="success">' + response.data.message + '</div>');
                } else {
                    $('#applyFormMessage').html('<div class="error">' + response.data.message + '</div>');
                }
                $btn.prop('disabled', false).text('Submit Application');
            },
            error: function() {
                $('#applyFormMessage').html('<div class="error">An error occurred. Please try again.</div>');
                $btn.prop('disabled', false).text('Submit Application');
            }
        });
    });
});
</script>

<style>
.apply-form-wrapper {
    max-width: 800px;
    margin: 0 auto;
}

.apply-intro {
    text-align: center;
    margin-bottom: 40px;
}

.apply-intro h2 {
    margin-bottom: 15px;
}

.apply-intro p {
    color: var(--text-muted);
}

.form-section-title {
    font-size: 18px;
    font-weight: 600;
    margin: 30px 0 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--primary);
}

.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid var(--border-color);
    border-radius: 4px;
    font-size: 16px;
    background: var(--input-bg);
    color: var(--input-color);
    transition: border-color 0.3s;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--primary);
}

.form-submit {
    margin-top: 30px;
    text-align: center;
}

.form-message {
    margin-top: 20px;
    text-align: center;
}

.form-message .success {
    padding: 15px;
    background: #d4edda;
    color: #155724;
    border-radius: 4px;
    border: 1px solid #c3e6cb;
}

.form-message .error {
    padding: 15px;
    background: #f8d7da;
    color: #721c24;
    border-radius: 4px;
    border: 1px solid #f5c6cb;
}

.btn {
    display: inline-block;
    padding: 14px 40px;
    background: var(--primary);
    color: #fff;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s;
}

.btn:hover {
    background: #0052a3;
}

.btn:disabled {
    background: #999;
    cursor: not-allowed;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
}
</style>

<?php get_footer(); ?>