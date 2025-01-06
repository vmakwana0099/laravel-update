<?php include('Templates/header.php') ?>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="text-center">
                <h2>Base Form Controls</h2>
            </div>
            <hr/>
            <form class="ac-form">
                <div class="form-group ac-form-group">
                    <label>Email address</label>
                    <input type="text" class="form-control ac-input" placeholder="Enter email">
                    <span class="ac-form-help">We'll never share your email with anyone else.</span>
                </div>
                <div class="form-group ac-form-group">
                    <label>Password</label>
                    <input type="password" class="form-control ac-input" placeholder="Password">
                </div>
                <div class="form-group ac-form-group">
                    <label>Static</label>
                    <p class="ac-form-control-static">email@example.com</p>
                </div>
                <div class="form-group ac-form-group">
                    <label>Example select</label>
                    <select class="form-control ac-input">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <div class="form-group ac-form-group">
                    <label>Bootstrap Select</label>
                    <select class="selectpicker ac-bootstrap-select" data-width="100%">
                        <option>Mustard</option>
                        <option>Ketchup</option>
                        <option>Relish</option>
                        <option>Tent</option>
                        <option>Flashlight</option>
                        <option>Toilet Paper</option>
                    </select>
                </div>
                <div class="form-group ac-form-group">
                    <label>Example multiple select</label>
                    <select multiple class="form-control ac-input">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                    </select>
                </div>
                <div class="form-group ac-form-group">
                    <label>Default Checkboxes</label>
                    <div class="ac-checkbox-list">
                        <label class="ac-checkbox">
                            <input type="checkbox"> Default<span></span>
                        </label>
                        <label class="ac-checkbox">
                            <input type="checkbox" disabled=""> Disabled<span></span>
                        </label>
                        <label class="ac-checkbox">
                            <input type="checkbox" checked=""> Checked<span></span>
                        </label>
                    </div>
                    <span class="ac-form-help">We'll never share your email with anyone else.</span>
                </div>
                <div class="form-group ac-form-group">
                    <label>Inline Checkboxes</label>
                    <div class="ac-checkbox-inline">
                        <label class="ac-checkbox">
                            <input type="checkbox"> Default<span></span>
                        </label>
                        <label class="ac-checkbox">
                            <input type="checkbox" disabled=""> Disabled<span></span>
                        </label>
                        <label class="ac-checkbox">
                            <input type="checkbox" checked=""> Checked<span></span>
                        </label>
                    </div>
                </div>
                <div class="form-group ac-form-group">
                    <label>Default Radios</label>
                    <div class="ac-radio-list">
                        <label class="ac-radio">
                            <input type="radio" name="example_1" value="1"> Option 1<span></span>
                        </label>
                        <label class="ac-radio">
                            <input type="radio" name="example_1" value="2"> Option 2<span></span>
                        </label>
                        <label class="ac-radio">
                            <input type="radio" name="example_1" value="3" disabled=""> Disabled<span></span>
                        </label>
                        <label class="ac-radio">
                            <input type="radio" name="example_1" value="4" checked=""> Checked<span></span>
                        </label>
                    </div>
                    <span class="ac-form-help">We'll never share your email with anyone else.</span>
                </div>
                <div class="form-group ac-form-group">
                    <label>Inline Radio</label>
                    <div class="ac-radio-inline">
                        <label class="ac-radio">
                            <input type="radio" name="example_1" value="1"> Option 1<span></span>
                        </label>
                        <label class="ac-radio">
                            <input type="radio" name="example_1" value="3" disabled=""> Disabled<span></span>
                        </label>
                        <label class="ac-radio">
                            <input type="radio" name="example_1" value="4" checked=""> Checked<span></span>
                        </label>
                    </div>
                </div>
                <div class="form-group ac-form-group">
                    <label>Default Switch</label>
                    <span class="ac-switch">
                        <label>
                            <input type="checkbox" checked="checked" name="">
                            <span></span>
                    </label>
                    </span>
                    <span class="ac-switch">
                        <label>
                            <input type="checkbox" name="">
                            <span></span>
                    </label>
                    </span>
                </div>
                <div class="form-group ac-form-group">
                    <label>Switch With Icon</label>
                    <span class="ac-switch ac-switch__icon">
                        <label>
                            <input type="checkbox" checked="checked" name="">
                            <span></span>
                    </label>
                    </span>
                    <span class="ac-switch ac-switch__icon">
                        <label>
                            <input type="checkbox" name="">
                            <span></span>
                    </label>
                    </span>
                </div>
                <div class="form-group ac-form-group">
                    <label>Example textarea</label>
                    <textarea class="form-control ac-textarea" rows="3"></textarea>
                </div>
                <div class="form-group ac-form-group">
                    <div class="ac-checkbox-list">
                        <label class="ac-checkbox">
                            <input type="checkbox"> Remember my Preference<span></span>
                        </label>
                    </div>
                </div>
                <button type="reset" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </form>
        </div>

        <div class="col-sm-6">
            <div class="text-center">
                <h2>Material Design Forms</h2>
            </div>
            <hr/>
            <form class="ac-form ac-form-md">
                <div class="form-group ac-form-group">
                    <input type="text" class="form-control ac-input" value="admin" required="">
                    <label class="ac-label-md">Email address</label>
                    <span class="ac-form-help">We'll never share your email with anyone else.</span>
                </div>
                <div class="form-group ac-form-group">
                    <input type="password" class="form-control ac-input" required="">
                    <label class="ac-label-md">Password</label>
                </div>
                <div class="form-group ac-form-group">
                    <label>Static</label>
                    <p class="ac-form-control-static">email@example.com</p>
                </div>
                <div class="form-group ac-form-group">
                    <label>Example select</label>
                    <select class="form-control ac-input">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <div class="form-group ac-form-group">
                    <label>Bootstrap Select</label>
                    <select class="selectpicker ac-bootstrap-select" data-width="100%">
                        <option>Mustard</option>
                        <option>Ketchup</option>
                        <option>Relish</option>
                        <option>Tent</option>
                        <option>Flashlight</option>
                        <option>Toilet Paper</option>
                    </select>
                </div>
                <div class="form-group ac-form-group">
                    <label>Default Checkboxes</label>
                    <div class="ac-checkbox-list">
                        <label class="ac-checkbox">
                            <input type="checkbox"> Default<span></span>
                        </label>
                        <label class="ac-checkbox">
                            <input type="checkbox" disabled=""> Disabled<span></span>
                        </label>
                        <label class="ac-checkbox">
                            <input type="checkbox" checked=""> Checked<span></span>
                        </label>
                    </div>
                    <span class="ac-form-help">We'll never share your email with anyone else.</span>
                </div>
                <div class="form-group ac-form-group">
                    <label>Inline Checkboxes</label>
                    <div class="ac-checkbox-inline">
                        <label class="ac-checkbox">
                            <input type="checkbox"> Default<span></span>
                        </label>
                        <label class="ac-checkbox">
                            <input type="checkbox" disabled=""> Disabled<span></span>
                        </label>
                        <label class="ac-checkbox">
                            <input type="checkbox" checked=""> Checked<span></span>
                        </label>
                    </div>
                </div>
                <div class="form-group ac-form-group">
                    <label>Default Radios</label>
                    <div class="ac-radio-list">
                        <label class="ac-radio">
                            <input type="radio" name="example_1" value="1"> Option 1<span></span>
                        </label>
                        <label class="ac-radio">
                            <input type="radio" name="example_1" value="2"> Option 2<span></span>
                        </label>
                        <label class="ac-radio">
                            <input type="radio" name="example_1" value="3" disabled=""> Disabled<span></span>
                        </label>
                        <label class="ac-radio">
                            <input type="radio" name="example_1" value="4" checked=""> Checked<span></span>
                        </label>
                    </div>
                    <span class="ac-form-help">We'll never share your email with anyone else.</span>
                </div>
                <div class="form-group ac-form-group">
                    <label>Inline Radio</label>
                    <div class="ac-radio-inline">
                        <label class="ac-radio">
                            <input type="radio" name="example_1" value="1"> Option 1<span></span>
                        </label>
                        <label class="ac-radio">
                            <input type="radio" name="example_1" value="3" disabled=""> Disabled<span></span>
                        </label>
                        <label class="ac-radio">
                            <input type="radio" name="example_1" value="4" checked=""> Checked<span></span>
                        </label>
                    </div>
                </div>
                <div class="form-group ac-form-group">
                    <label>Default Switch</label>
                    <span class="ac-switch">
                        <label>
                            <input type="checkbox" checked="checked" name="">
                            <span></span>
                    </label>
                    </span>
                    <span class="ac-switch">
                        <label>
                            <input type="checkbox" name="">
                            <span></span>
                    </label>
                    </span>
                </div>
                <div class="form-group ac-form-group">
                    <label>Switch With Icon</label>
                    <span class="ac-switch ac-switch__icon">
                        <label>
                            <input type="checkbox" checked="checked" name="">
                            <span></span>
                    </label>
                    </span>
                    <span class="ac-switch ac-switch__icon">
                        <label>
                            <input type="checkbox" name="">
                            <span></span>
                    </label>
                    </span>
                </div>
                <div class="form-group ac-form-group">
                    <textarea class="form-control ac-textarea" rows="3" required=""></textarea>
                    <label class="ac-label-md">Example textarea</label>
                </div>
                <div class="form-group ac-form-group">
                    <div class="ac-checkbox-list">
                        <label class="ac-checkbox">
                            <input type="checkbox"> Remember my Preference<span></span>
                        </label>
                    </div>
                </div>
                <button type="reset" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </form>
        </div>

        <div class="col-sm-12">
            <hr/>
        </div>

        <div class="col-sm-6">
            <div class="text-center">
                <h2>Input Groups Bootstrap 4.0</h2>
            </div>
            <hr/>
            <form class="ac-form">
                <div class="form-group ac-form-group">
                    <label>Left Addon</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text ac-group-text">@</span>
                        </div>
                        <input type="text" class="form-control ac-input" placeholder="Email">
                    </div>
                    <span class="ac-form-help">We'll never share your email with anyone else.</span>
                </div>

                <div class="form-group ac-form-group">
                    <label>Right Addon</label>
                    <div class="input-group">
                        <input type="text" class="form-control ac-input" placeholder="Username">
                        <div class="input-group-append">
                            <span class="input-group-text ac-group-text">@example.com</span>
                        </div>
                    </div>
                </div>

                <div class="form-group ac-form-group">
                    <label>Joint Addons</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text ac-group-text">$</span>
                            <span class="input-group-text ac-group-text">0.0</span>
                        </div>
                        <input type="text" class="form-control ac-input" placeholder="Email">
                    </div>
                </div>

                <div class="form-group ac-form-group">
                    <label>Left & Right Addons</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text ac-group-text">#</span>
                        </div>
                        <input type="text" class="form-control ac-input" placeholder="Email">
                        <div class="input-group-append">
                            <span class="input-group-text ac-group-text">px</span>
                        </div>
                    </div>
                </div>

                <div class="form-group ac-form-group">
                    <label>Multiple inputs</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text ac-group-text">First and last name</span>
                        </div>
                        <input type="text" class="form-control ac-input" placeholder="First">
                        <input type="text" class="form-control ac-input" placeholder="Last">
                    </div>
                </div>

                <div class="form-group ac-form-group">
                    <label>Left Addon with Icon Groups</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text ac-group-text">
                                <i class="la la-exclamation-triangle"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control ac-input" placeholder="Email">
                    </div>
                    <span class="ac-form-help">We'll never share your email with anyone else.</span>
                </div>

                <div class="form-group ac-form-group">
                    <label>Button addons</label>
                    <div class="input-group">
                        <input type="text" class="form-control ac-input" placeholder="Email">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">Button</button>
                        </div>
                    </div>
                </div>

                <div class="form-group ac-form-group">
                    <label>Left & Right Button addons</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button class="btn btn-primary" type="button">-</button>
                        </div>
                        <input type="text" class="form-control ac-input" placeholder="Email">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">+</button>
                        </div>
                    </div>
                </div>

                <div class="form-group ac-form-group">
                    <label>Buttons with dropdowns</label>
                    <div class="input-group">
                        <input type="text" class="form-control ac-input" placeholder="Email">
                        <div class="input-group-append">
                            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group ac-form-group">
                    <label>Custom select</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text ac-group-text">@</span>
                        </div>
                        <select class="form-control ac-input">
                            <option selected>Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>

                <div class="form-group ac-form-group">
                    <label>Bootstrap Select</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text ac-group-text">@</span>
                        </div>
                        <select class="form-control selectpicker ac-bootstrap-select" data-width="100%">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                            <option>Tent</option>
                            <option>Flashlight</option>
                            <option>Toilet Paper</option>
                        </select>
                    </div>
                </div>

                <div class="form-group ac-form-group">
                    <label>Left Addon Example textarea</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text ac-group-text">@</span>
                        </div>
                        <textarea class="form-control ac-textarea" rows="3"></textarea>
                    </div>
                    <span class="ac-form-help">We'll never share your email with anyone else.</span>
                </div>

                <button type="reset" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </form>
        </div>

        <!-- <div class="col-sm-6">
            <div class="text-center">
                <h2>Input Groups Bootstrap 3.3.7</h2>
            </div>
            <hr/>
            <form class="ac-form">
                <div class="form-group ac-form-group">
                    <label>Left Addon</label>
                    <div class="input-group">
                        <span class="input-group-addon ac-group-text">@</span>
                        <input type="text" class="form-control ac-input" placeholder="Username">
                    </div>
                    <span class="ac-form-help">We'll never share your email with anyone else.</span>
                </div>

                <div class="form-group ac-form-group">
                    <label>Right Addon</label>
                    <div class="input-group">
                        <input type="text" class="form-control ac-input" placeholder="Username">
                        <span class="input-group-addon ac-group-text">@example.com</span>
                    </div>
                </div>

                <div class="form-group ac-form-group">
                    <label>Joint Addons</label>
                    <div class="input-group">
                        <span class="input-group-addon ac-group-text">$</span>
                        <span class="input-group-addon ac-group-text">0.0</span>
                        <input type="text" class="form-control ac-input" placeholder="Email">
                        <span class="input-group-addon ac-group-text">$</span>
                        <span class="input-group-addon ac-group-text">0.0</span>
                    </div>
                </div>

                <div class="form-group ac-form-group">
                    <label>Left & Right Addons</label>
                    <div class="input-group">
                        <span class="input-group-addon ac-group-text">#</span>
                        <input type="text" class="form-control ac-input" placeholder="Email">
                        <span class="input-group-addon ac-group-text">px</span>
                    </div>
                </div>

                <div class="form-group ac-form-group">
                    <label>Multiple inputs</label>
                    <div class="input-group">
                        <span class="input-group-addon ac-group-text">#</span>
                        <input type="text" class="form-control ac-input" placeholder="First">
                        <input type="text" class="form-control ac-input" placeholder="Last">
                    </div>
                </div>

                <div class="form-group ac-form-group">
                    <label>Left Addon with Icon Groups</label>
                    <div class="input-group">
                        <span class="input-group-addon ac-group-text"><i class="la la-exclamation-triangle"></i></span>
                        <input type="text" class="form-control ac-input" placeholder="Email">
                    </div>
                    <span class="ac-form-help">We'll never share your email with anyone else.</span>
                </div>

                <div class="form-group ac-form-group">
                    <label>Button addons</label>
                    <div class="input-group">
                        <input type="text" class="form-control ac-input" placeholder="Email">
                        <span class="input-group-btn"><button class="btn btn-primary" type="button">Button</button></span>
                    </div>
                </div>

                <div class="form-group ac-form-group">
                    <label>Left & Right Button addons</label>
                    <div class="input-group">
                        <span class="input-group-btn"><button class="btn btn-primary" type="button">-</button></span>
                        <input type="text" class="form-control ac-input" placeholder="Email">
                        <span class="input-group-btn"><button class="btn btn-primary" type="button">+</button></span>
                    </div>
                </div>

                <div class="form-group ac-form-group">
                    <label>Buttons with dropdowns</label>
                    <div class="input-group">
                        <input type="text" class="form-control ac-input" placeholder="Email">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="form-group ac-form-group">
                    <label>Custom select</label>
                    <div class="input-group">
                        <span class="input-group-addon ac-group-text">@</span>
                        <select class="form-control ac-input">
                            <option selected>Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>

                <div class="form-group ac-form-group">
                    <label>Custom select</label>
                    <div class="input-group">
                        <span class="input-group-addon ac-group-text">@</span>
                        <select class="form-control selectpicker ac-bootstrap-select" data-width="100%">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                            <option>Tent</option>
                            <option>Flashlight</option>
                            <option>Toilet Paper</option>
                        </select>
                    </div>
                </div>

                <div class="form-group ac-form-group">
                    <label>Left Addon Example textarea</label>
                    <div class="input-group">
                        <span class="input-group-addon ac-group-text">@</span>
                        <textarea class="form-control ac-textarea" rows="3"></textarea>
                    </div>
                    <span class="ac-form-help">We'll never share your email with anyone else.</span>
                </div>

                <button type="reset" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </form>
        </div> -->
    </div>
</div>
<div class="spacer_25"></div>
    
<?php include('Templates/footer_section.php') ?>

<script src="assets/js/main.js"></script>
</body>
</html>