<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }
 ?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>Learn and Help</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
  </head>
  <body>
  <?php include 'show-navbar.php'; ?>
  <?php show_navbar(); ?>
  <header class="inverse">
      <div class="container">
        <h1>Meet our<span class="accent-text">Instructors</span></h1>
      </div>
  </header>
    <section class="about-me">
      <div class="container">
        <h2>Hello, my name is<span class="accent-text">Dr. Siva Jasthi</span>
          <img src="images/siva.png" alt="pic of Siva"></h2>
		<ul>
          <li>Educator, Mentor, Author, Software Consultant</li>
          <li>Over 25 years of experience in the software industry.</li>
          <li>20 years of experience in teaching undergraduate classes at Metropolitan State University, MN, USA</li>
          <li>5 years of volunteering at the School of India for Languages and Culture (SILC) as “Digital Literacy program designer and coordinator”</li>
		</ul>
	  </div>
	</section>
	<section class="articles inverse">
	  <div class="container">
		<h2>Hello, my name is<span class="accent-text">Ishana Didwania</span>
		  <img src="images/Ishana.png" alt="pic of Ishana"></h2>
		<p>Ishana Didwania is a junior at Mahtomedi High School (class of '24). She began programming
		  at the age of 9 and joined a local Girls Who Code program when she was in middle school.
		  Simultaneously she began a 5-year computer science program at the School of India for
		  Languages and Culture (SILC) and completed the program in her sophomore year of high
		  school. Over those 5 years, Ishana has studied web development with HTML/CSS and
		  Javascript, PHP, MySQL and data management, Python, and Java. She is currently the
		  primary volunteer teacher at SILC for the HTML/CSS class, consisting of 20 students ranging
		  from 10-12 years old. She has completed over 75 volunteer hours in this role.</p>
		<br>
		<p>She is an Aspirations in Computer Science 2022 State Honorable Mention award recipient.
		  Ishana is passionate overall about STEM and challenges herself with math and science AP
		  courses and classes over the summer. She works at a senior living home in her town and
		  competes on her school's math team. She has also taken flute lessons and played in her
		  school band since 6th grade. She is a member of the Minnesota All-State band. She will be the
		  president of her school band for the 2022-23 school year. Overall, Ishana enjoys programming
		  and hopes to pursue a career in computer science. She wants to place an emphasis on
		  helping others as she has done in her volunteering so far.</p>
	  </div>
	</section>
  </body>
</html>
