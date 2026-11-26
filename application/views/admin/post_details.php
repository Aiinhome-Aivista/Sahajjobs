<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<style>
    body {
        font-family: 'Nunito', Arial, sans-serif !important;
    }

    /* ===== NEW LAYOUT ===== */

    .post-page-wrapper {
        display: flex;
        gap: 30px;
        max-width: 1300px;
        margin: 40px auto;
        align-items: flex-start;
    }

    .post-left {
        flex: 1;
        min-width: 0;
    }

    .post-sidebar {
        width: 320px;
        max-height: 900px;
        overflow-y: auto;
        position: sticky;
        top: 20px;
    }

    /* ===== SIDEBAR CARDS ===== */

    .sidebar-heading {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 15px;
        color: #6a0dad;
    }

    .sidebar-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
        margin-bottom: 20px;
        overflow: hidden;
        transition: transform .2s ease;
    }

    .sidebar-card:hover {
        transform: translateY(-4px);
    }

    .sidebar-card img {
        width: 100%;
        height: 160px;
        object-fit: cover;
    }

    .sidebar-card-content {
        padding: 15px;
    }

    .sidebar-card-title {
        font-size: 16px;
        font-weight: 700;
        color: #333;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* ===== YOUR EXISTING STYLES ===== */

    .post-detail-container {
        max-width: 900px;
        margin: 0;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .post-detail-image-container {
        width: 100%;
        height: 460px;
        padding: 0;
        background-color: #e9eff4;
        overflow: hidden;
    }

    .post-detail-image-container img {
        width: 100%;
        /*height: 100%;*/
        object-fit: cover;
        display: block;
        border-radius: 0;
    }

    .post-detail-content {
        padding: 30px;
    }

    .post-detail-content .category {
        font-size: 14px;
        color: #6a0dad;
        text-transform: uppercase;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .post-detail-content .title {
        font-size: 28px;
        color: #333;
        margin: 15px 0;
    }

    .post-detail-content .meta {
        font-size: 14px;
        color: #666;
        margin-bottom: 20px;
        padding-bottom: 15px;
    }

    .post-detail-content .full-content {
        font-size: 16px;
        color: #555;
        line-height: 1.7;
        margin-bottom: 30px;
    }

    .back-button {
        display: inline-block;
        background-color: #efda56;
        color: #333;
        padding: 12px 24px;
        text-decoration: none;
        border-radius: 4px;
        font-weight: bold;
    }

    .comment-section {
        max-width: 900px;
        margin: 40px 0;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    /* ===== RESPONSIVE ===== */

    @media (max-width: 992px) {
        .post-page-wrapper {
            flex-direction: column;
        }

        .post-sidebar {
            width: 100%;
            max-height: none;
            position: static;
        }

        .post-detail-container,
        .comment-section {
            max-width: 100%;
        }
    }

    /* ===== LATEST BLOGS SIDEBAR (NEW DESIGN) ===== */

    .latest-blogs-box {
        background: #f1f1f1;
        padding: 15px;
    }

    .latest-blogs-title {
        background: #ffd900;
        color: #000000;
        display: inline-block;
        padding: 8px 14px;
        font-weight: 700;
        font-size: 16px;
        margin-bottom: 15px;
    }

    /* each row */
    .latest-blog-item {
        display: flex;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #ddd;
        text-decoration: none;
    }

    .latest-blog-item:last-child {
        border-bottom: none;
    }

    /* thumbnail */
    .latest-blog-thumb img {
        width: 70px;
        height: 70px;
        object-fit: cover;
    }

    .no-thumb {
        width: 70px;
        height: 70px;
        background: #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    /* content */
    .latest-blog-title {
        font-size: 15px;
        font-weight: 700;
        color: #222;
        line-height: 1.4;
        margin-bottom: 4px;
    }

    .latest-blog-item:hover .latest-blog-title {
        color: #b39801;
    }

    .latest-blog-meta {
        font-size: 13px;
        color: #777;
    }

    .latest-scroll {
        max-height: 420px;
        overflow-y: auto;
        padding-right: 4px;
    }

    /* nice scrollbar (optional) */
    .latest-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .latest-scroll::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 10px;
    }


    /* ===== PREV NEXT NAV ===== */

    .post-nav-box {
        margin: 30px 0;
        padding: 20px 0;
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }

    .post-nav-item {
        width: 50%;
    }

    .post-nav-label {
        font-size: 13px;
        color: #777;
        margin-bottom: 6px;
    }

    .post-nav-title {
        color: #d8b800;
        font-weight: 600;
        text-decoration: none;
        line-height: 1.4;
        display: block;
    }

    .post-nav-title:hover {
        text-decoration: underline;
    }

    .post-nav-next {
        text-align: right;
    }

    @media (max-width: 576px) {
        .post-nav-box {
            flex-direction: column;
        }

        .post-nav-item,
        .post-nav-next {
            width: 100%;
            text-align: left;
        }
    }


    /* ===== SOCIAL SHARE ===== */

    .social-share {
        margin: 15px 0 25px;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        border-bottom: 1px solid #eee;
    }

    .social-share-label {
        font-size: 14px;
        color: #666;
        margin-right: 6px;
        font-weight: 600;
    }

    .share-btn {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-decoration: none;
        font-size: 16px;
        border-radius: 2px;
        transition: transform .15s ease, opacity .15s ease;
    }

    .share-btn:hover {
        transform: translateY(-2px);
        opacity: 0.9;
    }

    /* brand colors */
    .share-facebook {
        background: #1877f2;
    }

    .share-twitter {
        background: #000000;
        color: white;
    }

    .share-linkedin {
        background: #0a66c2;
    }

    .share-whatsapp {
        background: #25d366;
    }

    .share-copy {
        background: #6c757d;
    }



    /* ===== NEWSLETTER SUBSCRIBE ===== */

    .newsletter-box {
        margin: 30px 0 50px;
        padding: 25px;
        background: #f5f5f5;
        border-radius: 6px;
    }

    .newsletter-title {
        font-size: 20px;
        font-weight: 700;
        color: #111;
        margin-bottom: 18px;
    }

    .newsletter-input {
        width: 50%;
        height: 48px;
        padding: 0 14px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 15px;
        margin-bottom: 15px;
    }

    .newsletter-btn {
        background: #ffd900;
        color: #000000;
        border: none;
        padding: 12px 26px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 4px;
        cursor: pointer;
        transition: background .2s ease;
    }

    .newsletter-btn:hover {
        background: #c62828;
    }

    .newsletter-recaptcha {
        margin-bottom: 15px;
    }


    /* ===== captcha side-by-side ===== */
    .captcha-row {
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .captcha-image-box {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 0px;
        border-radius: 8px;
    }

    .captcha-refresh {
        font-size: 18px;
        color: #555;
        text-decoration: none;
    }

    .captcha-input-box {
        flex: 1;
        min-width: 200px;
    }

    /* mobile */
    @media (max-width: 576px) {
        .captcha-row {
            flex-direction: column;
            align-items: stretch;
        }

        .captcha-input-box {
            width: 100%;
        }
    }
    
    /* ===== BREADCRUMB ===== */

    .breadcrumb-box {
        font-size: 14px;
        margin: 10px 0 20px;
        color: #777;
    }

    .breadcrumb-box a {
        text-decoration: none;
        color: #6a0dad;
        font-weight: 600;
    }

    .breadcrumb-box a:hover {
        text-decoration: underline;
    }

    .breadcrumb-current {
        color: #555;
        font-weight: 600;
    }
</style>

<body>

    <div class="post-page-wrapper">

        <!-- LEFT SIDE -->
        <div class="post-left">

            <div class="post-detail-container">
                <?php if (!empty($post->featured_image)): ?>
                    <div class="post-detail-image-container">
                        <img src="<?= base_url($post->featured_image) ?>" alt="<?= htmlspecialchars($post->title) ?>">
                    </div>
                <?php else: ?>
                    <div class="post-detail-image-container">
                        <div class="no-image-detail">No Image</div>
                    </div>
                <?php endif; ?>

                <div class="post-detail-content">
                    <?php if (!empty($post->category_name)): ?>
                        <div class="category"><?= htmlspecialchars($post->category_name) ?></div>
                    <?php endif; ?>

                    <h1 class="title"><?= htmlspecialchars($post->title) ?></h1>

                    <p class="meta">
                        By <?= htmlspecialchars($post->author) ?> /
                        <?= date('F d, Y', strtotime($post->created_at)) ?>
                    </p>

                    <?php
                    $current_url = current_url();
                    $encoded_url = urlencode($current_url);
                    $encoded_title = urlencode($post->title);
                    ?>
                    
                    

                    <div class="social-share">
                        <span class="social-share-label">Share</span>

                        <!-- Facebook -->
                        <a class="share-btn share-facebook"
                            href="https://www.facebook.com/sharer/sharer.php?u=<?= $encoded_url ?>" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>

                        <!-- X (Twitter) -->
                        <a class="share-btn share-twitter"
                            href="https://twitter.com/intent/tweet?url=<?= $encoded_url ?>&text=<?= $encoded_title ?>"
                            target="_blank">
                            <i class="fab fa-x-twitter"></i>
                        </a>

                        <!-- LinkedIn -->
                        <a class="share-btn share-linkedin"
                            href="https://www.linkedin.com/sharing/share-offsite/?url=<?= $encoded_url ?>"
                            target="_blank">
                            <i class="fab fa-linkedin-in"></i>
                        </a>

                        <!-- WhatsApp -->
                        <a class="share-btn share-whatsapp"
                            href="https://api.whatsapp.com/send?text=<?= $encoded_title ?>%20<?= $encoded_url ?>"
                            target="_blank">
                            <i class="fab fa-whatsapp"></i>
                        </a>

                        <!-- Copy Link (Instagram workaround) -->
                        <a class="share-btn share-copy" href="javascript:void(0)"
                            onclick="copyBlogLink('<?= $current_url ?>')" title="Copy link">
                            <i class="fas fa-share-alt"></i>
                        </a>
                    </div>
                    
                    <!-- ===== BREADCRUMB ===== -->
                    <div class="breadcrumb-box">
                        <a href="<?= base_url() ?>">Home</a>
                        <span> <i class="fas fa-chevron-right"></i> </span>

                        <a href="<?= base_url('blogs') ?>">Blog</a>
                        <span> <i class="fas fa-chevron-right"></i> </span>

                        <span class="breadcrumb-current">
                            <?= htmlspecialchars($post->title) ?>
                        </span>
                    </div>

                    <div class="full-content">
                        <?= $post->content ?>
                    </div>

                </div>
            </div>

            <div class="post-nav-box">

                <!-- Previous -->
                <div class="post-nav-item">
                    <?php if (!empty($prev_post)): ?>
                        <div class="post-nav-label">Previous Post</div>
                        <a href="<?= base_url('blogs/'.$prev_post->slug) ?>" class="post-nav-title">
                            <?= htmlspecialchars($prev_post->title) ?>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Next -->
                <div class="post-nav-item post-nav-next">
                    <?php if (!empty($next_post)): ?>
                        <div class="post-nav-label">Next Post</div>
                        <a href="<?= base_url('blogs/'.$next_post->slug) ?>" class="post-nav-title">
                            <?= htmlspecialchars($next_post->title) ?>
                        </a>
                    <?php endif; ?>
                </div>

            </div>

            <!-- ===== NEWSLETTER SUBSCRIBE ===== -->
            <div class="newsletter-box">

                <div class="newsletter-title">
                    Join our newsletter for the latest updates and insights.
                </div>

                <form id="newsletter-form">

                    <input type="email" name="email" class="newsletter-input" placeholder="Enter your email for more updates"
                        required>

                    <button type="submit" class="newsletter-btn">
                        Subscribe Now
                    </button>

                </form>

            </div>


        </div>

        <!-- RIGHT SIDEBAR -->
        <div class="post-sidebar">

            <!-- ===== LATEST BLOGS ===== -->
            <div class="latest-blogs-box" style="margin-bottom:20px;">
                <div class="latest-blogs-title">LATEST ARTICLES</div>

                <div class="latest-scroll">
                    <?php if (!empty($latest_posts)): ?>
                        <?php foreach ($latest_posts as $lpost): ?>

                            <a href="<?= base_url('blogs/'.$lpost->slug) ?>" class="latest-blog-item">

                                <div class="latest-blog-thumb">
                                    <?php if (!empty($lpost->featured_image)): ?>
                                        <img src="<?= base_url($lpost->featured_image) ?>"
                                            alt="<?= htmlspecialchars($lpost->title) ?>">
                                    <?php else: ?>
                                        <div class="no-thumb">No Image</div>
                                    <?php endif; ?>
                                </div>

                                <div class="latest-blog-content">
                                    <div class="latest-blog-title">
                                        <?= htmlspecialchars($lpost->title) ?>
                                    </div>

                                    <div class="latest-blog-meta">
                                        <?= date('F d, Y', strtotime($lpost->created_at)) ?>
                                        | By <?= htmlspecialchars($lpost->author) ?>
                                    </div>
                                </div>

                            </a>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="color:#666;padding:10px;">No latest articles found.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- ===== RELATED ARTICLES (your existing one) ===== -->
            <div class="latest-blogs-box">
                <div class="latest-blogs-title">RELATED ARTICLES</div>

                <?php if (!empty($related_posts)): ?>
                    <?php foreach ($related_posts as $rpost): ?>

                        <a href="<?= base_url('blogs/'.$rpost->slug) ?>" class="latest-blog-item">

                            <div class="latest-blog-thumb">
                                <?php if (!empty($rpost->featured_image)): ?>
                                    <img src="<?= base_url($rpost->featured_image) ?>" alt="<?= htmlspecialchars($rpost->title) ?>">
                                <?php else: ?>
                                    <div class="no-thumb">No Image</div>
                                <?php endif; ?>
                            </div>

                            <div class="latest-blog-content">
                                <div class="latest-blog-title">
                                    <?= htmlspecialchars($rpost->title) ?>
                                </div>

                                <div class="latest-blog-meta">
                                    <?= date('F d, Y', strtotime($rpost->created_at ?? 'now')) ?>
                                    | By <?= htmlspecialchars($lpost->author) ?>
                                </div>
                            </div>

                        </a>

                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="color:#666;padding:10px;">No related articles found.</p>
                <?php endif; ?>

            </div>

        </div>
    </div>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        document.getElementById('newsletter-form')?.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const btn = this.querySelector('button');
            const originalText = btn.textContent;

            btn.textContent = 'Subscribing...';
            btn.disabled = true;

            fetch('<?= base_url("admin/post_details/subscribe") ?>', {
                method: 'POST',
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    alert(data.message);
                    if (data.success) this.reset();
                })
                .catch(() => alert('Something went wrong.'))
                .finally(() => {
                    btn.textContent = originalText;
                    btn.disabled = false;
                });
        });
    </script>
    <script>
        function copyBlogLink(url) {
            navigator.clipboard.writeText(url).then(() => {
                alert('Link copied! You can paste it on Instagram.');
            });
        }
    </script>

</body>

</html>