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
	    <a class="nav-link <?php if ($CURRENT_PAGE == "Enrollment") {?>active<?php }?>" href="enroll.php">Enrollment</a>
	  </li>
	<li class="nav-item">
	    <a class="nav-link <?php if ($CURRENT_PAGE == "Student") {?>active<?php }?>" href="student.php">Student</a>
	  </li>	
	<li class="nav-item">
	    <a class="nav-link <?php if ($CURRENT_PAGE == "Drop Down") {?>active<?php }?>" href="drop.php">Drop Down</a>
	  </li>	
	</ul>
</div>
