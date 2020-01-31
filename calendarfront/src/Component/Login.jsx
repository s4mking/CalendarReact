import React from 'react';
import profile from "../Assets/profile.jpg"
import api from "./Api"

class Login extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            email: "",
            password: ""
        };
    }

    handleChange = (e) => {
        this.setState({[e.target.name]:e.target.value})
    }

    handleSubmit(e) {
        e.preventDefault()
        api.getToken(this.state.email,this.state.password).then((json) => {
            console.log("eliott", json)
        })
    }

    logout = () => {
        localStorage.clear('token');
    }

    render() {
        return (
            <div class="wrapper fadeInDown">
                <div id="formContent">
                    <div class="fadeIn first">
                        <img src={profile} id="icon" alt="User Icon" />
                    </div>

                    <form onSubmit={this.handleSubmit.bind(this)}>
                        <input type="text" id="login" class="fadeIn second" name="email" value={ this.state.email } onChange={ this.handleChange }  placeholder="login"/>
                        <input type="text" id="password" class="fadeIn third" name="password" value={ this.state.password } onChange={ this.handleChange } placeholder="password"/>
                        <button type="submit" class="fadeIn fourth" value="Log In"/>
                    </form>

                    <form id="formFooter" onSubmit={this.logout.bind(this)}>
                        <button type="submit"/> Logout
                    </form>

                </div>
            </div>
        )
    }
}

export default Login;