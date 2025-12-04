## Mock Test Service WebApp

The Mock Test Service WebApp enables students and educators to efficiently create, manage, and attempt practice exams. It provides a realistic test-taking environment with instant feedback, performance analytics, and multilingual support (ex: English and Japanese). The system ensures a smooth experience for learners preparing for academic or competitive exams.

## Features

- Test Creation:
  - Create mock tests by subject and topic.
  - Support for multiple question types (MCQ, True/False)
  - Upload question banks via CSV or manual entry


- Test Taking

 - Timer-based test environment (exam-like interface)
 - Randomized question shuffling to prevent repetition
 - Multilingual support for test instructions and questions

- Evaluation & Results
 - Auto-grading for objective questions
 - Manual evaluation for descriptive answers
 - Detailed scorecards with correct/incorrect answers
 - Performance aalytics (accuracy, speed, topic-wise breakdown)

- User Management
 - Admin panel for managing students, teachers, and roles
 - Assign specific tests to groups or individuals

- Reports & History
 - Access complete test history for each student
 - Export results in PDF/Excel format
 - Leaderboard and ranking system

## Future Plans

- Adaptive difficulty based on student performance
- Integration with learning management systems (LMS)
- Mobile app support for offline test-taking

---


# How to run
#### First clone the repo. To do that open your terminal and run bellow code

``if you use SSH ``
> git clone origin git@github.com:asifmdhasan/mock_service.git


``if you use HTTPS ``
> git clone origin https://github.com/asifmdhasan/mock_service.git

#### Run the composer command to get all the packages with into vendor directory
> composer install

#### Install NPM
>  npm install 

#### Create `` .env `` file from `` .env.example ``. To do that go to project directory and run

>  cp .env.example .env

#### Generate app key

>  php artisan key:generate


#### Changes the database configuration in `` .env `` file

>DB_DATABASE=your_database_name

>DB_USERNAME=root

>DB_PASSWORD=


#### Run the migration command to get all the table into your database
> php artisan migrate


#### Create symbolink link
>  php artisan storage:link


<!-- #### Create custom symbolink link -->
<!-- mklink /D C:\laragon\www\CameraUploader\public\uploads D:\CameraUploader\uploads -->







<!-- #### Run the jwt secret to generate secret for API authentication
> php artisan jwt:secret -->
<!-- 
#### Finally, Run the command to get the Bangladesh geo-location data
> php artisan BangladeshGeocode:setup -->


