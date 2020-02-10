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
            <div className="wrapper fadeInDown">
                <div id="formContent">
                    <div className="fadeIn first">
                        <img src={profile} id="icon" alt="User Icon" />
                    </div>

                    <form onSubmit={this.handleSubmit.bind(this)}>
                        <input type="text" id="name" className="fadeIn second" name="username" value={ this.state.username } onChange={ this.handleChange }  placeholder="First name"/>
                        <input type="text" id="login" className="fadeIn second" name="email" value={ this.state.email } onChange={ this.handleChange } placeholder="Email"/>
                        <input type="text" id="password" className="fadeIn third" name="password" value={ this.state.password } onChange={ this.handleChange } placeholder="Password"/>
                        <button type="submit" className="fadeIn fourth" value="Register"/>
                    </form>

                    <div id="formFooter">
                        <a className="underlineHover" href="/logout">Welcome</a>
                    </div>

                </div>
            </div>
        )
    }
}

export default Register;