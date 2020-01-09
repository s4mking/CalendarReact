import React from 'react';
import profile from "../Assets/profile.jpg"

class Register extends React.Component {
    render() {
        return (
            <div class="wrapper fadeInDown">
                <div id="formContent">
                    <div class="fadeIn first">
                        <img src={profile} id="icon" alt="User Icon" />
                    </div>

                    <form>
                        <input type="text" id="name" class="fadeIn second" name="login" placeholder="First name"/>
                        <input type="text" id="login" class="fadeIn second" name="login" placeholder="Email"/>
                        <input type="text" id="password" class="fadeIn third" name="login" placeholder="Password"/>
                        <input type="text" id="repeatpassword" class="fadeIn third" name="login" placeholder="Repeat Password"/>
                        <input type="submit" class="fadeIn fourth" value="Register"/>
                    </form>

                    <div id="formFooter">
                        <a class="underlineHover" href="/logout">Welcome</a>
                    </div>

                </div>
            </div>
        )
    }
}

export default Register;