<?php
require_once 'config.php';

// Fetch comments
$conn = getDBConnection(); // This should now work
$sql = "SELECT * FROM comments ORDER BY created_at DESC";
$result = $conn->query($sql);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>visionABLE MANILA</title>
    <link rel="icon" href="/able.jpeg" type="image/jpeg" sizes="32x32">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleFile.css">
    <link rel="stylesheet" href="commentstyle.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>
<body>


    <header>
        <a href="" class="brand" data-aos="zoom-in" data-aos-duration="1000">visionABLE MANILA</a>
        <div class="menu-btn">
            <div class="menu-btn__burger"></div>
        </div>
        <div class="navigation">
            <a href="#main" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                <span>Home</span>
                <div class="nav-line"></div>
            </a>
            <a href="#dpwh-talks" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <span>Signage Matters</span>
                <div class="nav-line"></div>
            </a>
            <a href="#article" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                <span>Article</span>
                <div class="nav-line"></div>
            </a>
            <a href="#services" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                <span>Public signage</span>
                <div class="nav-line"></div>
            </a>
            
            <a href="#FileUpload" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
                <span>Files</span>
                <div class="nav-line"></div>
            </a>
            <a href="#comments-section" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="700">
                <span>Comment</span>
                <div class="nav-line"></div>
            </a>
        </div>
    </header>

    <section class="main" id="main">
        <div class="main-img reveal">
        <video autoplay loop muted playsinline>
            <source src="Titas_Intro.mp4" type="video/mp4">
            <!-- Fallback image if video doesn't load -->
            <img src="able.png" alt="">
        </video>
        </div>
            <div class="home-content">
                <h1>Welcome to VisionABLE Manila</h1>
                <h3 class="typing-text"><span class="animated-text"></span><span class="cursor"></span></h3>
            
                <br><p><span>Where every sign leads to inclusion.
                <br>We advocate for accessible public signage
                <br>for people with visual impairments because
                <br>clear signs create safer, more inclusive cities.<br>
                Watch. Learn. Share. Be part of the change.
</span></p></br>
                
               <!-- <div class="social-icons">
                    <a href="" title="LinkedIn Profile"><i class="fa-brands fa-linkedin"></i></a>
                    <a href="" title="GitHub Profile"><i class="fa-brands fa-github"></i></a>
                    <a href="" title="Facebook Profile"><i class="fa-brands fa-facebook"></i></a>
                    <a href="" title="TikTok Profile"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="" title="Instagram Profile"><i class="fa-brands fa-instagram"></i></a>
                </div> -->
                <!--<a href="#contact" class="btn">Hire me</a>
                <a href="resume/" class="btn" download="">Download CV</a> -->
            </div>
    </section>

<!--  About Section -->

    <section class="dpwh-talks"  id="dpwh-talks"></section>
        <div class="title-container">
            <h2 class="section-title" data-aos="fade-up" data-aos-duration="1000">DPWH Talks</h2>
            <p class="subtitle" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                Making Public Signage Accessible for the Visually Impaired
            </p>
        </div>
    
        <div class="video-content-container">
            <div class="video-wrapper" data-aos="fade-in" data-aos-duration="1500" data-aos-delay="400">
                <source src="DPWH-TALKS.png" alt="">
                <video autoplay loop muted playsinline>
                    <source src="Titas_Intro.mp4" type="video/mp4">
                    <!-- Fallback image if video doesn't load -->
                    <img src="Image/able.png" alt="DPWH Talks about accessible signage">
                </video>
            </div>
            <div class="description-wrapper" data-aos="fade-in" data-aos-duration="1500" data-aos-delay="600">
                <p class="video-description">
                    An in-depth interview with DPWH on current efforts, challenges, and future plans to improve public
                    signage for people with low vision in Metro Manila
                </p>
            </div>
        </div>

        <section class="accessibility-campaign">
            <div class="title-container">
                <h2 class="section-title" data-aos="fade-up" data-aos-duration="1000">Through the Eyes of PWD</h2>
                <p class="subtitle" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    Perspectives on Public Signage
                </p>
            </div>
        
            <div class="campaign-content-container">
                <div class="text-content" data-aos="fade-in" data-aos-duration="1500" data-aos-delay="400">
                    <h2 class="content-title" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
                        <b>Accessibility</b>
                    </h2>
                    <p class="campaign-description">
                        Real stories and daily struggles of people with low vision, to be presented to DPWH and MMDA to
                        highlight the urgent need for inclusive and accessible public signage in Metro Manila.
                    </p>
                </div>
        
                <div class="video-wrapper" data-aos="fade-in" data-aos-duration="1500" data-aos-delay="600">
                    <video autoplay loop muted playsinline class="responsive-video">
                        <source src="Titas_Intro.mp4" type="video/mp4">
                        <!-- Fallback image if video doesn't load -->
                        <img src="Image/able.png" alt="Accessibility campaign about public signage">
                    </video>
                </div>
            </div>
      
  
        

       
        <br><br
        <!-- Animated background particles -->
        <div class="particles" id="particles"></div>

            <div class="title-container">
                <h2 class="section-title" data-aos="fade-up" data-aos-duration="1000">Why Accessible Signage Matters</h2>
                <p class="subtitle" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    Seeing the City Through Inclusive Design

                </p>
            </div>
            </div>
    <center> <p class="paragraph-text" data-aos="flip-up" data-aos-duration="1000" data-aos-delay="400">
        Giving attention to public signage is important because signs guide people through everyday life <br>especially in complex
        environments like roads, transport terminals, hospitals, and government buildings. 
        </p></center>
            <div class="timeline">
                <!-- Elementary School -->
                <div class="timeline-item">
                    <div class="timeline-card">
                       <!-- <span class="date"></span> -->
                        <h2>Safety</h2> 
                        <p><strong>
                        Clear and accessible signage prevents accidents. For people with visual impairments, good signage can mean the
                        difference between a safe commute and a dangerous situation like missing exits, crossing roads unsafely, or getting lost
                        in unfamiliar spaces.
</strong></p>
                        
                        
                    </div>
                </div>
        
                <!-- High School -->
                <div class="timeline-item">
                    <div class="timeline-card">
                       <!-- <span class="date"></span> -->
                        <h2>Navigation and Confidence</h2>
                        <p><strong>
Public signs help everyone find their way. But for persons with low vision or other disabilities, poor signage becomes a barrier. Accessible signs restore a person’s
 freedom to move independently, without needing constant assistance.</strong></p>
                        
                        </div>
                    </div>
                </div>
        
                <!-- Senior High School -->
                <div class="timeline-item">
                    <div class="timeline-card">
                       <!--<span class="date"></span> -->
                        <h2>Inclusion and Equal Access</h2>
                        <p><strong>
                        When signs are designed only for people with perfect vision, it excludes a large part of the population including the
                        elderly, people with disabilities, and even those in low-light or high-glare conditions. Inclusive signage ensures
                        everyone is considered.</strong></p>
                        
                      
                    </div>
                </div>
        
                <!-- Internship -->
                <div class="timeline-item">
                    <div class="timeline-card">
                        <!-- <span class="date"></span> -->
                        <h2>It’s a Right Not a Privilege</h2>
                        <p><strong>
                        Under international standards like the UN Convention on the Rights of Persons with Disabilities (CRPD), accessible
                        information and signage are part of every citizen’s right to access public services.</strong></p>
                        
                    </div>
                </div>
        
                <!-- College -->
                <div class="timeline-item">
                    <div class="timeline-card">
                        <!-- <span class="date"></span> -->
                        <h2>Better Urban Design</h2>
                        <p><strong>
                        Cities that invest in inclusive signage are more organized, user-friendly, and future ready. It reflects a commitment to
                        universal design, <b>where the environment works for all people, regardless of ability.</b></strong></p>
                       
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Skill Section -->

<section class="article" id="article" aria-label="Accessible Signage Article">
    <div class="container">
        <div class="title">
            <h1 class="section-title" data-aos="fade-up" data-aos-duration="1000">Beyond the Surface</h1>
            <h2 class="section-subtitle" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">Why Accessible
                Signage Should Come in All Forms</h2>
        </div>

        <div class="content">
            <div class="col-left">
                <p class="paragraph-text" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="300">
                Imagine turning a simple walk to the store into a puzzle of blurred signs, hidden curbs, and uncertain paths that’s
                daily life for someone with low vision. Across the Philippines and past, thousands and thousands of people with visual
                impairments come across needless daily obstacles lots of them as a result of something so commonplace we regularly take
                it without any consideration: signage. Whether too small, low in assessment, poorly placed, or missing entirely,
                inaccessible signage limits independence, compromises safety, and chips away at a person’s dignity.
                </p>

                

                <p class="paragraph-text" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="400">
                    The trouble isn't without answers. Research shows that simple design modifications could make a substantial difference
                    in accessibility. For example, signs ought to be at least seven percentage of the reading distance and feature a
                    excessive brightness evaluation to improve visibility for humans with low vision. Yet, regardless of those findings,
                    many present day accessibility requirements awareness heavily on tactile factors like Braille at the same time as
                    overlooking visual clarity. This leaves an opening for people who rely upon partial sight in preference to touch, making
                    it unnecessarily hard for them to study and interpret critical data in public spaces.
                </p>
                <p class="paragraph-text" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="500">
                    The effect of on hand signage is obvious in real global examples. At a college campus in Cebu,
                    students with visible impairments to start with struggled to navigate the grounds due to the absence
                    of good enough Braille wayfinding structures. Once nicely-designed Braille signage became installed,
                    these students reported a marked improvement of their orientation, mobility, and self assurance. The
                    transformation they skilled demonstrates that accessibility measures are not simply theoretical they
                    have tangible, existence converting effects on people's every day lives.
                </p>
            </div>


            <div class="col-right">
                

                <p class="paragraph-text" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="600">
                    Advancements in generation are actually paving the manner for more inclusive answers. Contemporary
                    digital signage systems can integrate multiple accessibility capabilities consisting of haptic
                    feedback, audio narration, Braille panels, and customizable show settings. Some even allow customers
                    to employ text-to-speech era to pay attention spoken content, regulate font size, or enhance
                    comparison. Audible format signage can flip static symptoms into interactive voice courses, while
                    virtual sign structures equipped with infrared readers and speaking maps offer indoor navigation
                    that supports independent journey for visually impaired users. These improvements aren't restrained
                    to serving people with vision impairments; they enhance navigation and consumer revel in for
                    everybody.
                </p>

                <p class="paragraph-text" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="700">
                    Accessibility, but, isn't a privilege or a charitable gesture it's miles a necessity. Public spaces
                    that contain clearer visuals, high assessment textual content, Braille, tactile paving, and audio
                    cues create environments where absolutely everyone can navigate properly and hopefully. By raising
                    cognizance, we can inspire nearby governments, agencies, and community planners to undertake
                    inclusive signage suggestions. The modifications required are regularly truthful, but the results
                    may be transformative.
                </p>

                <p class="paragraph-text" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="800">
                    In the stop, the route towards accessibility is not complicated it simply calls for the desire to
                    make it appear. If we work collectively, we will create areas where nobody is left questioning where
                    they're or in which they want to go. Signage ought to not be a barrier; it should be a bridge to
                    independence, protection, and dignity for all.
                </p>
            </div>
        </div>
    </div>
</section>

    <!-- Services Section -->
    <section class="services" id="services">
        <div class="title">
            <h2 class="section-title" data-aos="fade-up" data-aos-duration="1000">Suggested public signage</h2>
            
        </div>
        <div class="content">
            <!-- Web Design Card -->
            <div class="card" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
            <br><br><br> <div class="service-icon">
                    <!-- Replace this -->
                    <!-- <i class="fas fa-palette"></i> -->
            
                    <!-- With this (example path - use your actual image path) -->
                    <img src="image/unnamed.jpg" alt="">
                </div>
                <div class="info">
                    <h3>Downloadable Signage Templates</h3>
                    <p>Pre-designed inclusive signage samples that follow universal design principles.</p>
                </div>
                <br><br><br><br><button class="service-btn" onclick="openServiceModal('web-design')">Tunnel Vision</button>
            </div>
    
            <!-- Game Development Card -->
        <div class="card" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
            <br><br><div class="service-icon">
                <!-- Replace this -->
                <!-- <i class="fas fa-palette"></i> -->
        
                <!-- With this (example path - use your actual image path) -->
                <img src="image/unnamed-1.jpg" alt="">
            </div>
                <div class="info">
                    <h3><br>Share your story platform</h3>
                    <p>A space where PWDs and commuters with visual disabilities can submit personal stories, struggles, and suggestions
                    related to inaccessible signage. For data gathering and awareness
                    </p>
                </div>
                <button class="service-btn" onclick="openServiceModal('game-dev')">Color Blind</button>
            </div>
    
            <!-- Web Development Card -->
            <div class="card" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
            <br><br><br> <div class="service-icon">
                    <!-- Replace this -->
                    <!-- <i class="fas fa-palette"></i> -->
            
                    <!-- With this (example path - use your actual image path) -->
                    <img src="image/unnamed-2.jpg" alt="">
                </div>
                <div class="info">
                    <h3> MANILA Stories in Sight</h3>
                    <p>Watch real-life stories, expert interviews, and commuter struggles about inaccessible signage in Metro Manila. These
                    videos aim to educate, spark empathy, and push for inclusive change.
</p>
                </div>
                <br><br><button class="service-btn" onclick="openServiceModal('web-dev')">Patchy Visions</button>
            </div>
            <!-- Web Development Card -->
            <div class="card" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                <div class="service-icon">
                    <!-- Replace this -->
                    <!-- <i class="fas fa-palette"></i> -->
            
                    <!-- With this (example path - use your actual image path) -->
                    <img src="image/unnamed-3.jpg" alt="">
                </div>
                <div class="info">
                    <h3> </h3>
                    <p>
                    </p>
                </div>
                <br><br><button class="service-btn" onclick="openServiceModal('web-dev')">Blurred Vision</button>
            </div>
            </div>
        </div>
    
       


<section class="FileUpload" id="FileUpload">
    <div class="container">
        <h2 class="section-title">Input Data</h2>
    
        <div class="upload-section">
            <div class="upload-container" id="uploadContainer">
                <div class="upload-icon">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
                <h3>Drag & Drop your files here</h3>
                <p>or</p>
    
                <div class="file-input-wrapper">
                    <label class="file-label" for="fileInput">
                        <i class="fas fa-folder-open"></i> Browse Files
                    </label>
                    <input type="file" id="fileInput" multiple>
                </div>
    
                <div class="selected-files" id="selectedFiles"></div>
    
                <div class="progress-bar" id="progressBar">
                    <div class="progress" id="progress"></div>
                </div>
            </div>
    
            <button id="uploadBtn" disabled>
                <span class="spinner" id="uploadSpinner"></span>
                Upload Files
            </button>
    
            <div id="status" class="status"></div>
        </div>
    
        <div class="files-section">
            <h2 class="section-title">Downloadable Public Signage</h2>
            <div id="filesTableContainer">
                <table id="filesTable">
                    <thead>
                        <tr>
                            <th>File Name</th>
                            <th>Type</th>
                            <th>Size</th>
                            <th>Upload Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="filesTableBody">
                        <!-- Files will be listed here -->
                    </tbody>
                </table>
                <div id="noFilesMessage" class="no-files">
                    <i class="fas fa-folder-open" style="font-size: 2rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                    <p>No files uploaded yet. Upload your first file!</p>
                </div>
            </div>
        </div>
    </div>
    </section>

    <!-- The Modal -->
    <section class="comments-section" id="comments-section">
    <div class="comments-container">
        <div class="comments-header">
            <h2 class="section-title">Community Comments</h2>
            <h2 class="section-subtitle">Share your thoughts and join the conversation</h2>
        </div>

        <div class="comments-content">
            <div class="comment-form-container">
                <form class="contact-form" id="commentForm" method="POST" action="post_comment.php">
                    <h3 class="form-title">Leave Your Comment</h3>
                    
                    <div id="notificationArea"></div>

                    <div class="form-group">
                        <input type="text" id="comment_title" name="comment_title" required placeholder=" ">
                        <label for="comment_title">Comment Title</label>
                    </div>

                    <div class="form-group">
                        <textarea id="comment_text" name="comment_text" rows="5" required placeholder=" "></textarea>
                        <label for="comment_text">Share your thoughts...</label>
                    </div>

                    <button type="submit" class="submit-btn" id="submitBtn">
                        <span>Post Comment</span>
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>

            <div class="comments-list-container">
                <div class="comments-list" id="comments-list">
                    <?php 
                    // Database connection
                    $conn = new mysqli('localhost', 'root', '', 'fileuploads');
                    
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    
                    // Fetch comments from database
                    $sql = "SELECT title, comment, created_at FROM comments ORDER BY created_at DESC";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <div class="comment-card">
                            <div class="comment-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="comment-details">
                                <h3 class="comment-title"><?= htmlspecialchars($row['title']) ?></h3>
                                <p class="comment-text"><?= nl2br(htmlspecialchars($row['comment'])) ?></p>
                                <div class="comment-meta">
                                    <span class="comment-date"><?= date("F j, Y, g:i a", strtotime($row['created_at'])) ?></span>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="comment-card">
                            <div class="comment-icon">
                                <i class="fas fa-comment-slash"></i>
                            </div>
                            <div class="comment-details">
                                <h3 class="comment-title">No Comments Yet</h3>
                                <p class="comment-text">Be the first to share your thoughts!</p>
                            </div>
                        </div>
                    <?php endif; 
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add this JavaScript for AJAX form submission -->
<script>
document.getElementById('commentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = e.target;
    const formData = new FormData(form);
    const notificationArea = document.getElementById('notificationArea');
    
    fetch(form.action, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message
            notificationArea.innerHTML = '<div class="success-message">'+data.message+'</div>';
            
            // Clear the form
            form.reset();
            
            // Reload comments after a short delay
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            // Show error message
            notificationArea.innerHTML = '<div class="error-message">'+data.message+'</div>';
        }
    })
    .catch(error => {
        notificationArea.innerHTML = '<div class="error-message">An error occurred. Please try again.</div>';
    });
});
</script>


  <section class="footer" id="footer">
    
        <div class="footer-content">
            <div class="footer-main">
                <span class="footer-title">visionABLE MANILA</span>
                
            </div>
            <div class="footer-bottom">
                <p>Copyright ©2025 <a href="#">visionABLE MANILA</a>. All Rights Reserved.</p>
                <div class="footer-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Contact</a>
                </div>
            </div>
        </div>
    </footer>
    </section>


    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="script.js"></script>
    <script src="scriptFileUpload.js"></script>
    <script src="FileUploadScripts.js"></script>
    <script>
      AOS.init({offset:0});
    </script>
    <script>
    
        


    </script>
    <script src="script.js"></script>
    </div>
</body>
</html>


