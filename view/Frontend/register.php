
            <div class="container-fluid">
                    <div class="container container-center col-xs-8 col-xs-offset-2">
                        <form method='POST' action='<?php Router::findUrl("Frontend@register") ?>'>
                            <div class="form-group">
                                <label for="username">username</label>
                                <input type="text" class="form-control" id="username" placeholder="username" name='username' required>
                                <label for="password">password</label>
                                <input type="password" class="form-control" id="password" placeholder="password" name='password' required>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" required> Accept TOS
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                    </form>

                </div>
            </div>
