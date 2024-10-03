# Future Expansion Website

This project is a blog-style website built as part of my Web Programming 2 course. The site complements one of my personal passions—music production—by offering articles that accompany tutorial videos I create on my YouTube channel.

## Project Overview

I run a YouTube channel, [Future Expansion](https://www.youtube.com/@futurexpansion), where I help people learn how to produce their own music through step-by-step video tutorials. This website serves as a companion platform, where users can find written articles that expand on the topics covered in the videos. It also provides additional features, such as user management and multi-language support.

## Key Features

- **Article Creation (Admin Only)**:  
  Administrators can create new articles directly from the site. User roles are defined in the database, where a value of `1` in the `admin` field indicates an admin account. Regular users do not have access to these administrative features.

  Pre-configured admin account:
  - Username: `root`
  - Password: `root`

  The admin dashboard is accessible from the page `account.php`.

- **Multi-Language Support**:  
  The website supports both English and French, allowing users to switch between languages for a more personalized experience.

- **"Load More" Functionality**:  
  Articles are dynamically loaded using a "Load More" feature, accessible on the `all-lesson.php` page. This ensures that the user interface remains clean and easy to navigate, even as more content is added.

- **Responsive Design**:  
  The site is fully responsive and adapts to different screen sizes, ensuring optimal user experience on both desktop and mobile devices.

- **Security**:  
  The site includes measures to prevent XSS (Cross-Site Scripting) attacks, ensuring a safe environment for users and administrators alike.

## Getting Started

### Prerequisites

Make sure you have the following installed on your machine:
- PHP (version 7.4 or higher)
- Git

### Running the Project Locally

To set up the project on your local machine, follow these steps:

1. **Clone the repository**:
   ```bash
   git clone git@git.unistra.fr:gimhoff/project_web2_guillaumeimhoff.git
   ```

2. **Navigate to the project directory**:
   ```bash
   cd project_web2_guillaumeimhoff
   ```

3. **Start the development server**:
   You can run the site locally using PHP's built-in server:
   ```bash
   php -S 127.0.0.1:8000
   ```

4. **Open the site in your browser**:  
   Once the server is running, open your web browser and go to `http://127.0.0.1:8000` to view the website.
