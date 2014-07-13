<div class="row">
    <div class="col-md-12">
    <h1>Documentation <small><span class="text-info">Welcome</span> to <span class="text-primary">RS<strong>TRACK</strong>.org</span>! Here's how to get started.</small></h1>
    </div>
</div>

<div class="row doc">
    <div class="col-md-12">

        <h2>What is RS<strong>TRACK</strong>.org?</h2>
        <p>At RS<strong>TRACK</strong>.org, you can track all appointments booked for a clinical research study. This site is tailored for clinical research coordinators and assistants, though you may find it can come in handy for animal studies as well! RS<strong>TRACK</strong> is built for three things:</p> 

        <ol>
            <li>Scheduling study appointments</li>
            <li>Tracking subject progress to completion</li>
            <li>Tracking how your study's resources are being utilized</li>
        </ol>

        <p>In research coordination, these essential tasks are heavily interwoven. RS<strong>TRACK</strong> is an all-in-one tool to help you accomplish them. Here's how to use it:</p>

        <h2>1. The <a href="mystudy.php" target="_blank">My Study</a> Page <small>Build your Study</small></h2>
      
        <p>Now that you are registered, your username controls your study. Use the <a href="mystudy.php" target="_blank">My Study</a> page to build the framework of your study.</p>

        <h3>Timepoints</h3>

        <p>The typical framework of a clinical research study, especially those that are longitudinal, consists of timepoints that each call for certain components to be completed by all subjects. On your <a href="mystudy.php" target="_blank">My Study</a> page, add timepoints that are fundamental to your study design.</p>

        <p>For instance, do each of your subjects complete a baseline timepoint? Are they followed up with a year later? Then adding two timepoints named "Baseline" and "1-Year" might be a good start!</p>

        <h3>Components</h3>

        <p>Once your timepoints are set, add components to each. Components are the parts of your study that must occur at a certain timepoint. For instance, all clinical studies must have at minimum a consent. Since a consent must happen at baseline, you could add a "Consent" component to the "Baseline" timepoint and not to the "1-Year" timepoint.</p>

        <p>Create components that are likely to be completed in separate study appointments to eventually complete all that's required for its parent timepoint. Is a single subject asked to participate in an interview, a blood draw, and cognitive testing, but only at Baseline? Then create separate "Interview", "Blood Draw", and "Cognitive Testing" components for the "Baseline" timepoint. Is only the "Interview" completed at the "1-Year" timepoint? Then add it as another component for that follow-up timepoint.</p>

        <p>Once you have added all your timepoints and components, you are ready to move on to the <a href="resources.php" target="_blank">Resources</a> page. But don't forget about the <a href="mystudy.php">My Study</a> page! It is your central control page for adding timepoints, renaming them, and adding, editing, or deleting components as needed.</p>

        <h2>2. The <a href="resources.php" target="_blank">Resources</a> Page <small>Build for Utilization Tracking</small></h2>

        <p>Now that you have the timepoints and components set up for your study, go to the <a href="resources.php" target="_blank">Resources</a> page to add the resources your study uses for appointments.</p>

        <p>Components allocate three typical types of resources built into the site. Here they are listed with examples of each:</p>

            <ol>
                <li><strong>Staff</strong> - the names of clinicians, radiologists, assistants, or psychometricians</li> 
                <li><strong>Locations</strong> - specific room numbers, hospitals, clinics, or offices</li>
                <li><strong>Materials</strong> - interview binders, biological sampling kits, cognitive testing kits, or consent forms</li>
            </ol>

        <p>Resources are not committed to certain components or timepoints, nor each other. A staff member will be free to utilize any location using any materials for any appointment. As a result, clinicians can be assigned to a cognitive testing or a blood draw appointment if they happen to be trained for both. Sampling kits or interview binders can be utilized at Baseline or 1-Year. Resources are designed for flexibility.</p>

        <p>Consequently, the <a href="resources.php" target="_blank">Resources</a> page is simple. Add a row to add a resource. Select an existing resource row to edit its type or name. You can delete resources to, but keep in mind they can only be deleted if they haven't been utilized for any appointments.</p>

        <h2>3. The <a href="subjects.php" target="_blank">Subjects</a> Page <small>Build for Subject Tracking</small></h2>

        <p>Add, edit, or delete subjects from the <a href="subjects.php" target="_blank">Subjects</a> page.</p>

        <h3>Subject IDs</h3>

        <p>Subject IDs are typed in because ID assignment can change or skip order in a study for a multitude of reasons. Perhaps you only want to track subjects found eligible, omitting IDs that don't make it into the study. Or maybe there is a subject coding scheme unique to your study, such as odd numbers for eligible and even for ineligible, a required number of leading zeros, or prefixes for multi-site studies.</p>

        <p>This is why you can simply type in any desired subject ID. The only requirements are that they are 1) in number form and 2) unique.</p>

        <h3>Privacy</h3>

        <p>The initials field is the only other value you can enter for a subject. This is because HIPAA guidelines require privacy for any information that can identify a patient or research participant. rsTRACK.org is built to track subjects anonymously, so subject attributes like gender, address, health status, and so on are omitted to minimalize risk of mistaken disclosure.</p>

        <p>If you use rsTRACK.org for coordination, keep identifiable information separately. Check your research protocol or consent form for the specific policies enforced by your institution and/or research group.</p>

        <h2>4. The <a href="appointments.php" target="_blank">Appointments</a> Page <small>Finally, track it all!</small></h2>

        <p>The <a href="appointments.php" target="_blank">Appointments</a> page is where you can view all study goings on in one place.</p>

        <h3>Book Appointments</h3>

        <p>Each row represents an appointment. Add a row to book a new (or log an old) appointment. Each can consist of:</p>

        <ul>
            <li><strong>Subject ID</strong> - Select from a dropdown list of your study's subject IDs. The Initials field will automatically update based on your selection.</li>
            <li><strong>Initials</strong> - You can select the subject by initals as well. The Subject ID field will automatically update too.</li>
            <li><strong>Timepoint and Component</strong> - Select which component the appointment is for and for which timepoint. These are joined together so you don't pick a component for the wrong timepoint or vice versa.</li>
            <li><strong>Date</strong> - Select the date of the appointment from a dropdown calendar. This field can be left blank, so you can track the need for an appointment before your team has finalized a date for it.</li>
            <li><strong>Start & End Time</strong> - Enter a start and end time for your appointment. These fields can also be left blank in case you'll finalize a time later.</li>
            <li><strong>Staff</strong> - Select the staff member that will be responsible for running the subject through the appointment's chosen component.</li>
            <li><strong>Location</strong> - Select where the appointment will take place.</li> 
            <li><strong>Materials</strong> - What will staff need in order to complete the component? Select here.</li>
        </ul>

        <p>Multiple appointments can be booked for the same timepoint & component combination. Subjects may need to come in one or more times for any given component, especially if your component is time-consuming (e.g. a 6-hour cognitive testing battery). 

        <h3>Filtering Appointments</h3>

        <p>Use the filter box in the upper right-hand corner above the appointments table to filter your appointments by keyword. It will filter the table rows as you type to only those that contain your keyword. With this feature, you can customize your table view based on what you'd like to track. Enter a subject initials, for instance, to view only the appointments completed for a specific subject. Enter a staff member's name to view all the appointments they're responsible for. Enter a location name to see only the appointments that have taken place there. Enter a date if you need to find out who was seen on a particular day. With this tool, you can view only what you need to.</p>

        <h3>Edit Appointments</h3>

        <p>Modifying appointments is simple. Select the appointment row you want to change. An edit box will appear below the appointment table. It will have all the original values filled for you to see. Make any changes in the form and click the Edit Appointment button when finished.</p>

        <h3>Cancel Appointments</h3>

        <p>Cancelling appointments is simple as well. When you select an appointment row, a cancel box will appear below the appointment table as well. Cancellations are final and require just one click.</p>

        <h3>That's it!</h3>
        <p>Now you know all there is to get started on RS<strong>TRACK</strong>.org! Happy tracking.</p>

    </div>
</div>