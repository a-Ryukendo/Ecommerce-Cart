# 🚀 Deployment Guide - Court Data Fetcher

## Quick Start (Local Development)

### 1. Set up Python Environment
```bash
# Create virtual environment
python -m venv venv

# Activate virtual environment
# Windows:
venv\Scripts\activate
# Linux/Mac:
source venv/bin/activate

# Install dependencies
pip install -r requirements.txt
```

### 2. Configure Environment
```bash
# Copy environment template
cp env.example .env

# Edit .env file with your settings
# (See env.example for required variables)
```

### 3. Initialize Database
```bash
python init_db.py
```

### 4. Run Application
```bash
python app.py
```

### 5. Access Application
Open your browser and go to: `http://localhost:5000`

---

## Docker Deployment (Recommended)

### 1. Build and Run with Docker
```bash
# Build the Docker image
docker build -t court-data-fetcher .

# Run the container
docker run -p 5000:5000 court-data-fetcher
```

### 2. Using Docker Compose (Recommended)
```bash
# Start the application
docker-compose up -d

# View logs
docker-compose logs -f

# Stop the application
docker-compose down
```

---

## Cloud Hosting Options

### Option A: Heroku (Free Tier Available)

1. **Install Heroku CLI**
   ```bash
   # Download from: https://devcenter.heroku.com/articles/heroku-cli
   ```

2. **Create Heroku App**
   ```bash
   heroku create your-court-data-fetcher
   ```

3. **Deploy**
   ```bash
   git add .
   git commit -m "Initial deployment"
   git push heroku main
   ```

4. **Set Environment Variables**
   ```bash
   heroku config:set FLASK_ENV=production
   heroku config:set SECRET_KEY=your-secret-key
   ```

### Option B: Railway (Free Tier Available)

1. **Connect GitHub Repository**
   - Go to [railway.app](https://railway.app)
   - Connect your GitHub account
   - Select your repository

2. **Deploy**
   - Railway will automatically detect the Python app
   - Set environment variables in the dashboard
   - Deploy with one click

### Option C: Render (Free Tier Available)

1. **Create Account**
   - Sign up at [render.com](https://render.com)

2. **Create Web Service**
   - Connect your GitHub repository
   - Select Python environment
   - Set build command: `pip install -r requirements.txt`
   - Set start command: `python app.py`

3. **Configure Environment Variables**
   - Add all variables from `.env.example`

### Option D: DigitalOcean App Platform

1. **Create Account**
   - Sign up at [digitalocean.com](https://digitalocean.com)

2. **Deploy App**
   - Connect your GitHub repository
   - Select Python environment
   - Configure environment variables

### Option E: AWS Elastic Beanstalk

1. **Install AWS CLI**
   ```bash
   # Download from: https://aws.amazon.com/cli/
   ```

2. **Deploy**
   ```bash
   eb init
   eb create court-data-fetcher
   eb deploy
   ```

---

## Production Considerations

### 1. Environment Variables
Make sure to set these in production:
```bash
FLASK_ENV=production
SECRET_KEY=your-secure-secret-key
DATABASE_URL=your-production-database-url
```

### 2. Database
For production, consider using:
- **PostgreSQL** (Heroku, Railway, Render)
- **MySQL** (DigitalOcean, AWS)
- **SQLite** (for simple deployments)

### 3. Static Files
The application serves static files from the `static/` directory.

### 4. Logging
Logs are stored in the `logs/` directory. In production, consider:
- Cloud logging services
- Log aggregation tools

### 5. Security
- Use HTTPS in production
- Set secure SECRET_KEY
- Configure CORS if needed
- Rate limiting for API endpoints

---

## Monitoring and Maintenance

### Health Check
The application includes a health check endpoint:
```
GET /health
```

### Logs
Check application logs for errors and debugging:
```bash
# Docker
docker-compose logs -f

# Local
tail -f logs/app.log
```

### Database Backup
```bash
# SQLite backup
cp court_data.db backup_$(date +%Y%m%d_%H%M%S).db
```

---

## Troubleshooting

### Common Issues

1. **Port Already in Use**
   ```bash
   # Find process using port 5000
   netstat -ano | findstr :5000
   # Kill the process
   taskkill /PID <process_id> /F
   ```

2. **Database Errors**
   ```bash
   # Reinitialize database
   python init_db.py
   ```

3. **Docker Issues**
   ```bash
   # Clean up Docker
   docker system prune -a
   docker-compose down -v
   ```

4. **Environment Variables**
   - Ensure `.env` file exists
   - Check all required variables are set
   - Restart application after changes

---

## Performance Optimization

### 1. Caching
Consider implementing:
- Redis for session storage
- File caching for PDFs
- Database query caching

### 2. Database Optimization
- Add indexes for frequently queried columns
- Implement connection pooling
- Regular database maintenance

### 3. Static File Optimization
- Minify CSS and JavaScript
- Enable gzip compression
- Use CDN for static assets

---

## Support

For issues and questions:
1. Check the logs in `logs/app.log`
2. Review the README.md for setup instructions
3. Test the health endpoint: `/health`
4. Verify environment variables are set correctly

---

## Next Steps

After deployment:
1. Test all functionality
2. Set up monitoring
3. Configure backups
4. Set up CI/CD pipeline
5. Add SSL certificate
6. Implement rate limiting
7. Add analytics tracking 