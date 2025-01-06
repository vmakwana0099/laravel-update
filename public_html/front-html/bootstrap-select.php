<?php include('Templates/header.php') ?>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <h1>Bootstrap Select</h1>
            <hr/>
            <h5>Standard select boxes</h5>
            <select class="selectpicker ac-bootstrap-select" data-width="100%">
                <option>Mustard</option>
                <option>Ketchup</option>
                <option>Relish</option>
                <option>Tent</option>
                <option>Flashlight</option>
                <option>Toilet Paper</option>
            </select>

            <hr/>

            <h5>Select boxes with optgroups</h5>
            <select class="selectpicker ac-bootstrap-select" data-width="100%">
                <optgroup label="Picnic">
                    <option>Mustard</option>
                    <option>Ketchup</option>
                    <option>Relish</option>
                </optgroup>
                <optgroup label="Camping">
                    <option>Tent</option>
                    <option>Flashlight</option>
                    <option>Toilet Paper</option>
                </optgroup>
            </select>

            <hr/>

            <h5>Multiple select boxes</h5>
            <select class="selectpicker ac-bootstrap-select" data-width="100%" multiple>
                <option>Mustard</option>
                <option>Ketchup</option>
                <option>Relish</option>
                <option>Tent</option>
                <option>Flashlight</option>
                <option>Toilet Paper</option>
            </select>

            <hr/>

            <h5>Live search</h5>
            <select class="selectpicker ac-bootstrap-select" data-width="100%" data-live-search="true">
                <option>Mustard</option>
                <option>Ketchup</option>
                <option>Relish</option>
                <option>Tent</option>
                <option>Flashlight</option>
                <option>Toilet Paper</option>
            </select>

            <hr/>

            <h5>Key words</h5>
            <select class="selectpicker ac-bootstrap-select" data-width="100%" data-live-search="true">
                <option data-tokens="um">Mustard</option>
                <option data-tokens="ek">Ketchup</option>
                <option data-tokens="er">Relish</option>
                <option data-tokens="et">Tent</option>
                <option data-tokens="lf">Flashlight</option>
                <option data-tokens="pt">Toilet Paper</option>
            </select>

            <hr/>

            <h5>Limit the number of selections</h5>
            <select class="selectpicker ac-bootstrap-select" data-width="100%" multiple data-max-options="2">
                <option>Mustard</option>
                <option>Ketchup</option>
                <option>Relish</option>
                <option>Tent</option>
                <option>Flashlight</option>
                <option>Toilet Paper</option>
            </select>

            <hr/>

            <h5>Placeholder</h5>
            <select class="selectpicker ac-bootstrap-select" data-width="100%" multiple title="Choose one of the following...">
                <option>Mustard</option>
                <option>Ketchup</option>
                <option>Relish</option>
                <option>Tent</option>
                <option>Flashlight</option>
                <option>Toilet Paper</option>
            </select>

            <hr/>

            <h5>Selected text</h5>
            <select class="selectpicker ac-bootstrap-select" data-width="100%">
                <option title="Combo 1">Mustard</option>
                <option title="Combo 2">Ketchup</option>
                <option title="Combo 3">Relish</option>
                <option title="Combo 4">Tent</option>
                <option title="Combo 5">Flashlight</option>
                <option title="Combo 6">Toilet Paper</option>
            </select>

            <hr/>

            <h5>Selected text format</h5>
            <select class="selectpicker ac-bootstrap-select" data-width="100%" multiple data-selected-text-format="count">
                <option>Mustard</option>
                <option>Ketchup</option>
                <option>Relish</option>
                <option>Tent</option>
                <option>Flashlight</option>
                <option>Toilet Paper</option>
            </select>

            <hr/>

            <h5>Checkmark on selected option</h5>
            <select class="selectpicker ac-bootstrap-select show-tick" data-width="100%">
                <option>Mustard</option>
                <option>Ketchup</option>
                <option>Relish</option>
                <option>Tent</option>
                <option>Flashlight</option>
                <option>Toilet Paper</option>
            </select>

            <hr/>

            <h5>Width</h5>
            <select class="selectpicker ac-bootstrap-select" data-width="150px">
                <option>Mustard</option>
                <option>Ketchup</option>
                <option>Relish</option>
                <option>Tent</option>
                <option>Flashlight</option>
                <option>Toilet Paper</option>
            </select>

            <hr/>
        </div>
    </div>
</div>
<?php include('Templates/footer.php') ?>
</body>
</html>