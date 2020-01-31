import React from 'react';
import profile from "../Assets/profile.jpg"
import api from "./Api"

class Login extends React.Component {

    handleSubmit(e) {
        e.preventDefault()
        api.getToken((json) => {
            console.log("eee", json)
        })
    }

    render() {
        return (
            <div class="wrapper fadeInDown">
                <div id="formContent">
                    <div class="fadeIn first">
                        <img src={profile} id="icon" alt="User Icon" />
                    </div>

                    <form onSubmit={this.handleSubmit.bind(this)}>
                        <input type="text" id="login" class="fadeIn second" name="login" placeholder="login"/>
                        <input type="text" id="password" class="fadeIn third" name="login" placeholder="password"/>
                        <button type="submit" class="fadeIn fourth" value="Log In"/>
                    </form>

                    <div id="formFooter">
                        <a class="underlineHover" href="/logout">Forgot Password?</a>
                    </div>

                </div>
            </div>
        )
    }
}

export default Login;