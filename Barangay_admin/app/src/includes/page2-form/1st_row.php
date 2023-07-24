<!-- Basic Information -->
<div class="row fst-italic g-3 position-relative">

    <div class="form-group col-md-4">
        <label for="emp_id">Employee ID</label>
        <input type="text" name="emp_id" id="emp_id" class="form-control" placeholder="This will be automatically generated" 
        value="<?= $emp['emp_id'] ?? '' ?>" readonly>
    </div>
    <div class="col-md-4">
        <label for="Number-of-Dependent(s)">
            <span class="light-color">
                Number of Dependent(s)
            </span>
        </label>
        <input type="number" class="form-control " id="Number-of-Dependent(s)" placeholder="Number of people in your family" name="num_dependent" value="<?= $emp['num_dependent'] ?? '' ?>">
    </div>
    <div class="col-sm-2 ">
        <label for="PayDate">Date</label>
        <input name="emp_pay_date" type="date" class="form-control" id="PayDate" placeholder=" Pay Date " 
        value="<?= $emp['emp_pay_date'] ?? ''  ?>">
    </div>

    <div class="col-sm-2 col-md-2 text-sm-center img-thumbnail position-absolute top-0 end-0">
        <img src="<?= IMG_ASSETS_PATH ?>/default_profile_image.jpg" class="img-fluid" alt="employeeIdImage">
    </div>

</div>

<br>

<div class="row fst-italic g-3">
    <div class="col-sm-10 col-md-5 form-floating">
        <input name="f_name" type="text" class="form-control" id="FirstName" placeholder=" First Name" value="<?= $emp['f_name'] ?? '' ?>">
        <label for="FirstName"> First Name </label>
    </div>

    <div class="col-sm-10  col-md-5  form-floating ">
        <input name="l_name" type="text" class="form-control " id="LastName" placeholder=" Last Name " value="<?= $emp['l_name'] ?? '' ?>">
        <label for="LastName"> Last Name </label>
    </div>
</div>

<br>

<div class="row row-cols-sm-2 row-cols-md-4 g-3">
    <div class="col">
        <!-- select option for civil status -->
        <select name="emp_civil_status" class="form-select" id="CivilStatus" aria-label="Floating label select example">
            <option value="<?= $emp['emp_civil_status'] ?? 'civil status' ?>" selected>
                <!-- get the value -->
                <?php if (isset($emp['emp_civil_status'])) : ?>
                    <?= strtoupper($emp['emp_civil_status']) ?>
                <?php else : ?>
                    Civil Status
                <?php endif; ?>
            </option>
            <option value="single"> Single </option>
            <option value="married"> Married </option>
            <option value="widowed"> Widowed </option>
            <option value="separated"> Separated </option>
            <option value="divorced"> Divorced </option>
        </select>
    </div>

    <div class="col">
        <!-- select option for employee status -->
        <select name="emp_status" class="form-select" id="EmployeeStatus" aria-label="Floating label select example">
            <option value="<?= $emp['emp_status'] ?? 'employee status' ?>" selected>
                <!-- get the value -->
                <?php if (isset($emp['emp_status'])) : ?>
                    <?= strtoupper($emp['emp_status']) ?>
                <?php else : ?>
                    Employee Status
                <?php endif; ?>
            </option>
            <option value="regular"> Regular </option>
            <option value="contractual"> Contractual </option>
            <option value="probationary"> Probationary </option>
            <option value="none"> None of the above </option>
        </select>
    </div>

    <!-- designation selec option -->
    <div class="col-3">
        <select name="designation" class="form-select" id="Designation" aria-label="Floating label select example">
            <option value="<?= $emp['designation'] ?? 'designations' ?>" selected>
                <!-- get the value -->
                <?php if (isset($emp['designation'])) : ?>
                    <?= strtoupper($emp['designation']) ?>
                <?php else : ?>
                    Designations
                <?php endif; ?>
            </option>
            <option value="manager"> Manager </option>
            <option value="team_leader"> Team Leader </option>
            <option value="cashier"> Cashier </option>
            <option value="accountant"> Accountant </option>
            <option value="supervisor"> Supervisor </option>
            <option value="staff"> Staff </option>
            <option value="none"> None of the above </option>
        </select>
    </div>

    <!-- department select option -->
    <div class="col">
        <select name="department" class="form-select" id="Department" aria-label="Floating label select example">
            <option value="<?= $emp['department'] ?? 'department' ?>" selected>
                <!-- get the value -->
                <?php if (isset($emp['department'])) : ?>
                    <?= strtoupper($emp['department']) ?>
                <?php else : ?>
                    Department
                <?php endif; ?>
            </option>
            <option value="IT"> IT </option>
            <option value="hr"> HR </option>
            <option value="accounting"> Accounting </option>
            <option value="sales"> Sales </option>
            <option value="marketing"> Marketing </option>
            <option value="none"> None of the above </option>
        </select>
    </div>

</div>