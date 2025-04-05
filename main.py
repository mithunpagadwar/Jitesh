from flask import Flask, render_template, request, redirect, url_for, session, send_from_directory
import os
from datetime import datetime
from flask_sqlalchemy import SQLAlchemy
from sqlalchemy.orm import DeclarativeBase
import random
import string
import json

class Base(DeclarativeBase):
    pass

db = SQLAlchemy(model_class=Base)
app = Flask(__name__)
app.secret_key = os.environ.get("SESSION_SECRET", "grampanchayat_secret_key")
app.config["SQLALCHEMY_DATABASE_URI"] = os.environ.get("DATABASE_URL", "sqlite:///grampanchayat.db")
app.config["SQLALCHEMY_ENGINE_OPTIONS"] = {
    "pool_recycle": 300,
    "pool_pre_ping": True,
}
db.init_app(app)

class Complaint(db.Model):
    id = db.Column(db.String(20), primary_key=True)
    name = db.Column(db.String(100), nullable=False)
    mobile = db.Column(db.String(20), nullable=False)
    complaint_text = db.Column(db.Text, nullable=False)
    file_path = db.Column(db.String(255))
    status = db.Column(db.String(20), default='pending')
    created_at = db.Column(db.DateTime, default=datetime.utcnow)

class Setting(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    key = db.Column(db.String(50), unique=True, nullable=False)
    value = db.Column(db.Text, nullable=False)

class Resident(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(100), nullable=False)
    address = db.Column(db.String(255), nullable=False)
    mobile = db.Column(db.String(20), nullable=False)
    house_tax = db.Column(db.Float, default=500.0)
    water_tax = db.Column(db.Float, default=300.0)

class Payment(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    resident_id = db.Column(db.Integer, db.ForeignKey('resident.id'), nullable=False)
    amount = db.Column(db.Float, nullable=False)
    tax_type = db.Column(db.String(20), nullable=False)  # house or water
    receipt_number = db.Column(db.String(50), nullable=False)
    payment_date = db.Column(db.DateTime, default=datetime.utcnow)

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/schemes')
def schemes():
    return render_template('schemes.html')

@app.route('/gallery')
def gallery():
    return render_template('gallery.html')

@app.route('/housetax')
def housetax():
    return render_template('housetax.html')

@app.route('/complaint')
def complaint():
    return render_template('complaint.html')

@app.route('/check-complaint')
def check_complaint():
    return render_template('check_complaint.html')

@app.route('/admin-login')
def admin_login():
    return render_template('admin/login.html')

@app.route('/admin-dashboard')
def admin_dashboard():
    return render_template('admin/dashboard.html')

# WordPress थीम डाउनलोड के लिए रूट्स
@app.route('/download')
def download_page():
    return send_from_directory('.', 'download.html')

@app.route('/direct-download')
def direct_download_page():
    return send_from_directory('.', 'direct-download.html')

@app.route('/wordpress-theme/<path:filename>')
def download_theme(filename):
    return send_from_directory('wordpress-theme', filename)
    
@app.route('/download-theme')
def download_theme_direct():
    return send_from_directory('wordpress-theme', 'grampanchayat.zip')

# Create tables
with app.app_context():
    db.create_all()

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000, debug=True)
