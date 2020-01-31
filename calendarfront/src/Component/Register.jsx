import React from 'react';
import profile from "../Assets/profile.jpg"
import api from "./Api"


class Register extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            username: "",
            email: "",
            password: ""
        };
    }

    handleChange = (e) => {
        this.setState({[e.target.name]:e.target.value})
    }

    handleSubmit(e) {
        e.preventDefault()
        api.Register(this.state.username, this.state.email, this.state.password).then((json) =>{
            // this.props.changeStatus(true)
            console.log(json)
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
                        <input type="text" id="name" class="fadeIn second" name="username" value={ this.state.username } onChange={ this.handleChange }  placeholder="First name"/>
                        <input type="text" id="login" class="fadeIn second" name="email" value={ this.state.email } onChange={ this.handleChange } placeholder="Email"/>
                        <input type="text" id="password" class="fadeIn third" name="password" value={ this.state.password } onChange={ this.handleChange } placeholder="Password"/>
                        <button type="submit" class="fadeIn fourth" value="Register"/>
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