import mysql.connector
import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart

# ===============================
# DATABASE DETAILS
# ===============================
DB_HOST = "localhost"
DB_USER = "capdpgtz_syedarshad"
DB_PASS = "Arshad@22112025"
DB_NAME = "capdpgtz_sahajjobs_prod"

# ===============================
# EMAIL DETAILS
# ===============================
SMTP_SERVER = "mail.sahajjobs.com"
EMAIL_USER = "noreply@sahajjobs.com"
EMAIL_PASS = "Support@2025"
CC_EMAIL = "support@sahajjobs.com"

# ===============================
# CONNECT DATABASE
# ===============================
try:
    db = mysql.connector.connect(
        host=DB_HOST,
        user=DB_USER,
        password=DB_PASS,
        database=DB_NAME
    )
    cursor = db.cursor(dictionary=True)
    print("Database connected")
except Exception as e:
    print("Database connection failed:", e)
    exit()

# ===============================
# FETCH USERS
# ===============================
user_query = """
SELECT id, full_name, mail_id
FROM mailer_list
WHERE mail_id IS NOT NULL
"""
cursor.execute(user_query)
users = cursor.fetchall()
print(f"Users found: {len(users)}")

# TEST - only my email
# users = [{"full_name": "Sayan Mitra", "mail_id": "sayan.aiinhome@gmail.com"}]

# ===============================
# FETCH LATEST JOBS
# ===============================
job_query = """
SELECT title, company, location, created_at
FROM posted_jobs
ORDER BY created_at DESC
LIMIT 3
"""
cursor.execute(job_query)
jobs = cursor.fetchall()

# ===============================
# CONNECT SMTP
# ===============================
server = None
try:
    server = smtplib.SMTP(SMTP_SERVER, 587, timeout=30)
    server.starttls()
    server.login(EMAIL_USER, EMAIL_PASS)
    print("Connected using TLS (587)")
except Exception:
    print("TLS failed, trying SSL (465)...")
    try:
        server = smtplib.SMTP_SSL(SMTP_SERVER, 465, timeout=30)
        server.login(EMAIL_USER, EMAIL_PASS)
        print("Connected using SSL (465)")
    except Exception as e:
        print("Email server connection failed:", e)
        cursor.close()
        db.close()
        exit()

# ===============================
# SEND EMAILS
# ===============================
sent_count = 0
fail_count = 0

for user in users:
    try:
        full_name = user["full_name"]
        email = user["mail_id"]

        msg = MIMEMultipart("alternative")
        msg["From"] = EMAIL_USER
        msg["To"] = email
        msg["Cc"] = CC_EMAIL
        msg["Subject"] = "Happy Independence Day from SahajJobs!"

        # ===============================
        # JOB CARDS
        # ===============================
        jobs_html = ""
        for job in jobs:
            jobs_html += f"""
            <table width="100%" cellpadding="0" cellspacing="0"
            style="border:1px solid #e2e8f0;border-radius:12px;padding:15px;margin-bottom:18px;">
            <tr>
                <td>
                    <h3 style="margin:0;color:#eab308;font-size:18px;font-weight:bold;">
                        {job['title']}
                    </h3>
                    <p style="margin:6px 0 0 0;color:#475569;font-size:14px;">
                        {job['company']} | {job['location']}
                    </p>
                </td>
            </tr>
            </table>
    """

        # ===============================
        # FULL HTML
        # ===============================
        html_body = f"""
<!DOCTYPE html>
<html>

<body style="margin:0;padding:0;background-color:#f1f5f9;
             font-family:Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0"
       style="background-color:#f1f5f9;padding:30px 0;">

<tr>
<td align="center">

<table width="650" cellpadding="0" cellspacing="0"
       style="background:#ffffff;border-radius:14px;
              overflow:hidden;box-shadow:0 8px 30px rgba(0,0,0,0.08);">

<!-- Logo -->
<tr>
<td align="center" style="padding:30px 20px 15px 20px;">

    <img src="https://sahajjobs.com/./ALL_UPLOADS/images/SahajJOB2.png"
         width="140"
         style="display:block;"
         alt="SahajJobs">

</td>
</tr>


<!-- Independence Day Greeting -->
<tr>
<td style="padding:15px 40px 5px 40px;text-align:center;">

    <h2 style="margin:0;color:#1e293b;font-size:24px;">
        Happy Independence Day, {full_name}!
    </h2>

    <p style="color:#64748b;font-size:15px;line-height:1.6;margin-top:12px;">
        This Independence Day, let's celebrate the freedom to dream,
        the courage to grow, and the opportunities that help us build
        a brighter future.
    </p>

</td>
</tr>


<!-- Independence Day Banner -->
<tr>
<td align="center" style="padding:20px 30px 10px 30px;">

    <img src="https://sahajjobs.com/./ALL_UPLOADS/images/Ind_SJobs.jpeg"
         width="100%"
         style="display:block;border-radius:14px;"
         alt="Happy Independence Day - SahajJobs">

</td>
</tr>


<!-- Aspirations Message -->
<tr>
<td style="padding:15px 40px 10px 40px;text-align:center;">

    <h2 style="margin:0;color:#1e293b;font-size:22px;">
        Freedom to Dream. Opportunity to Grow.
    </h2>

    <p style="color:#64748b;font-size:14px;line-height:1.7;margin-top:10px;">
        Just as our nation continues to move forward with ambition and
        determination, every career journey begins with a dream and
        the right opportunity.
    </p>

    <p style="color:#475569;font-size:14px;line-height:1.7;">
        At <strong>SahajJobs</strong>, we believe in connecting aspirations
        with opportunities and helping you take the next step toward
        your career goals.
    </p>

</td>
</tr>


<!-- Section Title -->
<tr>
<td align="center" style="padding:20px 40px 10px 40px;">

    <h2 style="margin:0;color:#1e293b;font-size:24px;">
        Opportunities That Move You Forward
    </h2>

    <p style="color:#64748b;font-size:14px;margin-top:10px;">
        {len(jobs)} new career opportunities waiting for you on SahajJobs.
    </p>

</td>
</tr>


<!-- Job Cards -->
<tr>
<td style="padding:20px 40px;">

{jobs_html}

</td>
</tr>


<!-- Career Message -->
<tr>
<td style="padding:5px 40px 20px 40px;text-align:center;">

    <p style="color:#64748b;font-size:14px;line-height:1.6;">
        Your next opportunity could be the beginning of something
        extraordinary. Keep exploring, keep learning, and keep moving forward.
    </p>

</td>
</tr>


<!-- CTA Button -->
<tr>
<td align="center" style="padding:10px 40px 40px 40px;">

<a href="https://www.sahajjobs.com/"
   style="background:#facc15;color:#000;text-decoration:none;
          padding:14px 38px;border-radius:8px;font-weight:bold;
          font-size:16px;display:inline-block;">

    Explore Career Opportunities

</a>

</td>
</tr>


<!-- Footer -->
<tr>
<td style="background:#f8fafc;text-align:center;padding:25px;
           color:#64748b;font-size:13px;
           border-top:1px solid #e2e8f0;">

    <p style="margin:5px 0;font-weight:bold;color:#334155;">
        Connecting Aspirations with Opportunities
    </p>

    <p style="margin:8px 0;">
        🇮🇳 Wishing you a proud and inspiring Independence Day!
    </p>

    <p style="margin:8px 0;">
        © 2026 SahajJobs. All rights reserved.
    </p>

</td>
</tr>


</table>
</td>
</tr>

</table>

</body>
</html>
"""

        msg.attach(MIMEText(html_body, "html"))

        server.sendmail(
            EMAIL_USER,
            [email, CC_EMAIL],
            msg.as_string()
        )

        sent_count += 1
        print(f"Sent to {email}")

    except Exception as e:
        fail_count += 1
        print(f"Failed for {email}: {e}")

# ===============================
# CLEANUP
# ===============================
server.quit()
cursor.close()
db.close()

print("=================================")
print(f"Emails sent: {sent_count}")
print(f"Failed emails: {fail_count}")
print("=================================")
