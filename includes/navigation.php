<div class="container">
	<ul class="nav nav-tabs">
	  <li class="nav-item">
	    <a class="nav-link <?php if ($CURRENT_PAGE == "Index") {?>active<?php }?>" href="index.php">Home</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link <?php if ($CURRENT_PAGE == "Course") {?>active<?php }?>" href="course.php">Course</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link <?php if ($CURRENT_PAGE == "Instructor") {?>active<?php }?>" href="instructor.php">Instructors</a>
	  </li>
	<li class="nav-item">
	    <a class="nav-link <?php if ($CURRENT_PAGE == "Take") {?>active<?php }?>" href="take.php">Take</a>
	  </li>
	<li class="nav-item">
	    <a class="nav-link <?php if ($CURRENT_PAGE == "Student") {?>active<?php }?>" href="student.php">Student</a>
	  </li>	
	<li class="nav-item">
	    <a class="nav-link <?php if ($CURRENT_PAGE == "Cards") {?>active<?php }?>" href="course-cards.php">Cards</a>
	  </li>
	</ul>
</div>
