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
# EMAIL DETAILS (GMAIL)
# ===============================
SMTP_SERVER = "smtp.gmail.com"
SMTP_PORT = 587
EMAIL_USER = "teamsahajjobs@gmail.com"
EMAIL_PASS = "pejq rhtf qpsw hsjh"
CC_EMAIL = "support@sahajjobs.com"

# ===============================
# CONNECT DATABASE
# ===============================
db = mysql.connector.connect(
host=DB_HOST,
user=DB_USER,
password=DB_PASS,
database=DB_NAME
)

cursor = db.cursor(dictionary=True)

# ===============================
# USERS WITHOUT CV
# ===============================
query = """
SELECT r.id, r.full_name, r.email
FROM register r
LEFT JOIN resumes rs ON r.id = rs.user_id
WHERE rs.user_id IS NULL
"""

cursor.execute(query)
users = cursor.fetchall()

# ===============================
# EMAIL SERVER
# ===============================
server = smtplib.SMTP(SMTP_SERVER, SMTP_PORT)
server.starttls()
server.login(EMAIL_USER, EMAIL_PASS)

# ===============================
# SEND EMAILS (HTML)
# ===============================
for user in users:
    full_name = user["full_name"]
    email = user["email"]

    msg = MIMEMultipart("alternative")
    msg["From"] = EMAIL_USER
    msg["To"] = email
    msg["Cc"] = CC_EMAIL
    msg["Subject"] = "Reminder: Upload Your Resume – SahajJobs"

    html_body = """
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Upload Resume - SahajJobs</title>
<style>
body {{
    font-family: Arial, sans-serif;
    background-color: #f8fafc;
    padding: 20px;
    color: #334155;
}}
.container {{
    background: #ffffff;
    max-width: 600px;
    margin: auto;
    border-radius: 12px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.06);
    overflow: hidden;
}}
.content {{
    padding: 32px;
}}
.greeting {{
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 20px;
    color: #1e293b;
}}
.message {{
    font-size: 15px;
    margin-bottom: 18px;
}}
.note {{
    background-color: #eff6ff;
    padding: 18px;
    border-radius: 10px;
    border-left: 4px solid #3b82f6;
    margin: 24px 0;
}}
.note-title {{
    font-weight: 600;
    color: #1d4ed8;
    margin-bottom: 8px;
}}
.footer {{
    text-align: center;
    font-size: 13px;
    color: #64748b;
    padding: 20px;
    border-top: 1px solid #e2e8f0;
}}
</style>
</head>

<body>
<div class="container">
    <div class="content">

        <p class="greeting">Hello {full_name},</p>

        <p class="message">
            We noticed that you have not uploaded your resume yet on <strong>SahajJobs</strong>.
        </p>

        <div class="note">
            <div class="note-title">Next Steps</div>
            <p>
                Please log in to your SahajJobs account and upload your resume.
            </p>
            <p style="margin-top: 10px;">
                Website:
                <a href="https://www.sahajjobs.com/" target="_blank">
                    https://www.sahajjobs.com/
                </a>
            </p>
        </div>

        <p>Best regards,</p>
        <p><strong>The SahajJobs Team</strong></p>

        <div style="margin-top: 16px;">
                <img src="https://sahajjobs.com/./ALL_UPLOADS/images/SahajJOB2.png" alt="SahajJobs Logo" width="140"
                    style="display: block; max-width: 140px;">
            </div>

    </div>

    <div class="footer">
        <p>This is an automated email. Please do not reply.</p>
        <p>&copy; 2026 SahajJobs. All rights reserved.</p>
    </div>
</div>
</body>
</html>
""".format(full_name=full_name)

    msg.attach(MIMEText(html_body, "html"))
    server.sendmail(
        EMAIL_USER,  
        [email, CC_EMAIL], 
        msg.as_string()   
    )



server.quit()
cursor.close()
db.close()

print("CV reminder emails sent successfully.")