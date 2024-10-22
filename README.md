
# WiseJobs 🦉 - Job Board Application

## Project Overview

WiseJobs is a responsive and performant job board application developed as part of the Wise Publishing Frontend Challenge. The application allows users to browse job listings, filter them based on various criteria, and view details about each job. Admin users have the ability to manage companies and job postings.

## Features

### User Features:
- **Browse Jobs**: View a list of the latest published jobs with smooth scrolling.
- **Filter Jobs**: Filter jobs based on:
  - Position type: Remote or in-person
  - Salary range
  - Company
  - Location
- **Job Details**: Click to view detailed information about individual job postings.

### Admin Features:
- **Company Management**:
  - Create, update, and delete companies.
  - View all companies with the number of job postings per company.
  - View individual company details.
- **Job Management**:
  - Create, update, and delete job postings for selected companies.
  - View individual job postings.

## Core Technologies
- **Backend**: Laravel
- **Frontend**: Alpine.js, vanilla JavaScript, Blade templating, HTML, Tailwind CSS

## Performance Optimization

- **Core Web Vitals**: The app is optimized for FCP, LCP, and CLS to ensure a smooth, fast experience.
- **Lazy Loading**: Job postings and images are lazy-loaded to reduce initial load times.
- **Minification and Compression**: CSS and JS assets are minified and compressed for better performance.

## UI/UX Enhancements

- **Responsive Design**: Fully responsive across mobile, tablet, and desktop.
- **User-friendly Filters**: The filter options are intuitive and provide clear feedback when applied.
- **Microinteractions**: Subtle animations and transitions enhance the user experience.


## Architecture

- **Reusable Components**: Job cards, filter options, and forms are reusable across the application using Blade templates and Alpine.js.
- **Separation of Concerns**: Data fetching is cleanly separated from UI rendering to ensure scalability.
- **CSS Architecture**: The app uses **Tailwind CSS** utility-first classes for a highly maintainable and scalable design.

## Tailwind CSS Integration

I used **Tailwind CSS** for styling to ensure a fast development workflow and clean, scalable styles. Tailwind’s utility-first approach allowed for rapid styling with responsive and accessible classes. The key benefits include:
- **Responsive Utilities**: Tailwind’s responsive modifiers helped me create mobile-first designs quickly.
- **Dark Mode**: Tailwind’s built-in dark mode support was used to implement a dark mode toggle.
- **Custom Configuration**: The Tailwind config file was customized to suit the project’s design needs (if any customizations were made).

## Setup Instructions

### Prerequisites

Make sure you have the following installed on your system:
- PHP >= 8.2
- Composer
- Node.js and npm

### Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/sahiljani/full-stack-challenge/
   cd full-stack-challenge/wisejobs 

2. **Install Backend Dependencies:**:
   ```bash
    composer install
3. **Install Frontend Dependencies:**:
   ```bash
    npm install
4. Set Up Environment: Create a .env file by copying .env.example and configuring your database:
   ```bash
    cp .env.example .env
    php artisan key:generate
5. Migrate the Database and Seed Data:
   ```bash
    php artisan migrate --seed
6. Run Development Server:
   ```bash
    php artisan serve
7. Compile Frontend Assets:
   ```bash
    npm run dev
### Test Login Credentials

You can use the following credentials to log in as a test user:

- **Email**: `test@test.com`
- **Password**: `123456`

Navigate to `/login` to access the login page.

### Screenshorts

![enter image description here](https://i.imgur.com/Q1FxsV5.png)


![enter image description here](https://i.imgur.com/pXa0z0O.png)

![enter image description here](https://i.imgur.com/E8yDKoQ.png)

![enter image description here](https://i.imgur.com/0NZkMsV.png)