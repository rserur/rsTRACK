<div class="doc">
  <h1>Design <small class>Technical details of RS<strong>TRACK</strong>.org</small></h1>

    <h2>DreamHost and MAMP</h2>

    <p>I began by uploading the skeleton of my site to my free DreamHost account via FTP and planning my directory structure (includes, public, and templates) on an MVC model based on pset7, chmoding as needed. It quickly became evident that I'd need an instant solution similar to CS50 Appliance, but with more speed and programs to choose from, so I configured my MacBook with <a href="http://www.mamp.info" target="_blank">MAMP</a>, short for Macintosh, Apache, MySQL, and PHP, a free program that installs all the aforementioned technologies as a local server enivonment on my computer.</p>

    <p>I began saving all my files into my Dropbox and configured my MAMP localhost to direct to an rstrack directory. I needed to reenter my "includes/constants.php" file definitions to localhost settings, but MAMP made that easy.</p>

    <p>With MAMP, I thereafter worked locally on my project with <a href="http://www.sublimetext.com" target="_blank">Sublime Text</a>, learning how to use a few helpful plugin packages along the way (BracketHighlighter, a Less > Css compiler, Emmet, SublimeLinter) that <em>really</em> helped me navigate my code, though I learned the hard way (that is, late in the game) that I was better off not delving too deeply into their syntaxes and settings for time's sake.</p>


  <h2>mySQL Database</h2>

  <p>I initially began to build the underlying mySQL database for rsTRACK.org with phpMyAdmin, as installed with Dreamhost and MAMP. My process was to first write much of my site's form HTML on each page to get an idea of how to structure the interface, then create the corresponding databases based on what data my site would collect for each section.</p>

  <h3>Basic Structure</h3>

  <p>I decided on 6 tables, creating them as I coded corresponding pages, in this order:</p>

  <ol>
    <li><strong>users</strong> - for research coordinators/staff that could use the site for their study</li>
    <li><strong>subjects</strong> - for study subjects</li>
    <li><strong>timepoints</strong> - for timepoints the users would add for their study protocol</li>
    <li><strong>components</strong> - for the different assessments and measures that a user would like to track at each timepoint</li>
    <li><strong>resources</strong> - for staff, locations, and materials</li>
    <li><strong>appts</strong> - for appointments that would draw upon every other table.</li>
  </ol>

  <p>These were categories I felt would be most generalizably helpful to use in any kind of study, regardless of its content. So "components" can be biological, psychological, sociological, etc. in nature and be tracked by the same table, customized by the user for their study's needs. "Timepoints" have obvious tracking advantages for longitudinal studies, but they may also be implemented differently by a shorter study if the user wishes.</p>

  <p>I first envisioned a "resources" table much more customizable by users, so that instead of hardcoding "staff", "locations", and "materials", I could allow the user to create their own resource types. That way they could have a different resource type for each kind of staff member needed (e.g. separating clinicians and assistants) or they could let multiple materials be used for a single appointment.</p>

  <h3>Diagramming</h3>

  <p>I downloaded <a href="http://www.mysql.com/downloads/tools/workbench">mySQL Workbench</a> (Community Edition) to visually figure out a way to allow that level of customization with mySQL. I learned how to "reverse engineer" my existing database into an EER diagam, modify the diagram in the program, and then synchronize the model with my localhost database.</p> 

  <p>Diagramming helped me realize that such customizability would require too much control given to the user (perhaps creating tables for each) and could quickly result in an extremely large database beyond the scope of this project, so that is how I decided on "staff", "location", and "materials" columns instead under "resources". With these three categories also agnostic to study purpose or design, it could still be flexible and customizable enough for any study.</p>

  <div class="panel panel-default">
    <div class="panel-heading">
        <h3>Final Database Model</h3>
    </div>
    <div class="panel-body">
        <img src="img/rstrack_EER.png" class="img-responsive">
    </div>
  </div>

  <h3>Indexes</h3>

  <p>Through mySQL workbench, I also visually decided on many of my primary and foreign keys, realizing that fewer mandatory unique values were required than I first thought. It was enough to use the user ID ("u_id") in tandem with unique timepoint numbers ("point_num" - not autoincremented for user customization), autoincremented component IDs ("comp_ID)", and unique subject IDs ("sub_ID" - again not autoincremented to allow for easy changes by the user).</p>

  <p>Finally, the appointments ("appts") table came together naturally by using foreign keys to every other table, since it is the table that every other table is ultimately constructed for.</p>

  <h2>PHP</h2>

  <p>As based on pset7, I originally designed my project for an MVC model. I used pset7 code for "includes/config.php", "includes/functions.php", and "includes/constants.php" after doing some research on what is minimally included in a PHP website. I compared the pset7 design to those in two older books, <em>Build Your Own Database Driven Website Using PHP and MySQL</em> by Kevin Yank and <em>PHP and MySQL for Dynamic Web Sites</em> by Larry Ullman. Although they referred to older versions of languages, I found that much of the pset7 configuration is a standard base for any direction I might want to try, so decided to use it instead of reinvent something.</p>

  <h3>Forms</h3>

  <p>I was surprised to find that although simple loops and if/else statements could accomplish many of my basic PHP and mySQL form interactions server-side, jQuery was a great (if challenging) way to mediate those interactions on the frontend. (I'll describe this later in its own section.)

  <h3>Functions</h3>

  <p>I created a series of "getBlank" functions (getResource, getComp, getSub, and getPoint) that would allow me to grab values from other tables and insert them into a table-specific array-creating loop.</p>

  <p>For instance, I use getResource in my index.php page. On line 134, I began looping through my "appts" database to create an array for my appointment table cell values. I only stored resource IDs in the "appts" mySQL table, but needed to feed the names of the resources to the template. So I created and used the getResource function to tailor a query to the "resources" mySQL table that would grab the a resource's name by resource_ID.</p>

  <p>This method came in handy many times in writing every page, though I wish I had the time to figure out how to create just one or two "getBlank" functions, since they all basically do the same thing. I couldn't figure out rewriting the syntax quickly enough, so decided to use what I had.</p>

  <h2>jQuery and Bootstrap</h2>

  <p>I did not initially realize how much jQuery I'd be using, but its usage proved essential time and time again.</p>

  <h3>Designing the Subjects and Resources Pages</h3>

  <p>The two pages I wanted to tackle first, starting the whole project, were Subjects and Resources (as they were both essential and the simplest).  They are more or less the same, so I'll just describe Subjects here.</p>

  <p>I wanted this site to be as easy and uncluttered as possible for the user, so designed the pages to really focus on their respective tables. Sidling and squishing the tables to accomodate add, edit, or delete forms would really detract from the functionality. This is why I wanted applicable forms to pop up only when needed, visually clear but not in the way. So I used jQuery to allow the table to respond to the user's selections as appropriate.</p>

  <p>Test runs immediately made it clear what users would expect, what they'd find intuitive, so I used jQuery to made their form selections more fluid. For instance, users wouldn't think to enter values into the #new_sub_row fields <em>and</em> select the row's radio input, so I selected it for them.</p>

  <h3>Designing the My Study Page</h3>

  <p>It took several tries to come up with an intuitive-enough study overview page. Using Bootstrap's grid system really helped, though minding the divs was painstakingly tedious work (here and throughout the site).</p>

  <p>So I think of the My Study page as extremely complicated, but realize now that this impression is probably clouded by the effects of that tedium upon my memory.</p>

  <h3>Designing the Appointments Page</h3>

  <p>This page was absolutely the most complicated, enough so to go over several of its features.</p>

  <h4>The Book Appointment Row</h4>

  <p>I found that this row required me to:</p>

  <ol>
  <li>Use the initials value alone, as selected by the user from the subjects mySQL table, to get the sub_id value. I ended up creating the $uni_subjects array in index.php to do so. In retrospect, a hidden autoincremented ID for the subjects table would have been much simpler!</li>
  <li>Synchronize the selections of Subject ID and Initials, as accomplished with jQuery in the "template/appt_form.php" page starting on line 348.</li>
  <li>For Timepoint and Component, concatenate the two dropdowns to make clear how components are unique. An alternative was to use jQuery so that the user must select a Timepoint first and populate the Component dropdown accordingly. I realized that required a chain of PHP and jQuery interactions I could not implement in time. Again in retrospect, additional mySQL indexes would have made this much simpler.</li>
  <li>Use jQuery UI's datepicker for the date field.</li>
  <li>Settle on using the HTML5 input type of "time" for the start and end appointment times.</li>
  </ol>

  <h4>The Edit Appointment Box</h4>

  <p>The PHP array that produced my appointment table's HTML did not leave traces of the <em>every</em> corresponding value of the SQL database, so I needed to populate the form through other means. It turned out that a series of .val() jQuery functions would not properly prepopulate the Edit Form (see line 261 in appt_form). After a lot of research and dead ends, I finally realized that although .val() can select an option for you based on the text inside of option tag, it will not do so if there is a value. If there is a value, it will try to select that in your target dropdown. That's why it failed to prepopulate #edit_id, #edit_inits... most of the edit options. So I settled on a filter method instead to match text instead of values.</p>

  <p>My need to concatenate Timepoint and Component caused trouble again in the Edit Form, though the solution was very simple in the end. I originally concatenated them with the ASCII value for the symbol " &124; ". I didn't realize this, so thought that both the .val() and filter approaches were failing for no apparent reason. Spent too much time trying other approaches before it hit me to not use an ASCII value and enter it straight from the keyboard.</p>

  <h4>Filter Box</h4>

  <p>Fortunately it turned out that filtering is amazingly simple in jQuery! Added a great boost to functionality that I'm looking forward to tweaking and replicating in the future.</p>

  <h3>Final Notes</h3>

  <p>Much of the design went hand-in-hand with my usage of Bootstrap and some customization with LESS CSS via the <a href="http://www.crunchapp.net" target="_blank">Crunch</a> compiler. I learned much of this for the first time by taking Interactive Media though Harvard Extension concurrently with CS50, so I couldn't be more grateful for that timing and overlap.</p>

  <p>After using as much jQuery as I did, in the future I may want to separate the code into .js files.</p>

  <p>The site is functionally responsive though the grid system! A site like this on a mobile phone would be a lifesaver for many research coordinators.</p>

  <p>The future directions of this project are endless; lots of features could be added, so I'm glad to get a head start on it with this project!</p>
</div>