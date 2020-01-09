import React from "react";
import {
  BrowserRouter as Router,
  Route,
  Link
} from "react-router-dom";
import Login from "../Component/Login"
import Register from "../Component/Register"


export default function MyRoute() {
    return (
        <Router>
            <div>
                <ul>
                    <li>
                        <Link to="/">Home</Link>
                    </li>
                    <li>
                        <Link to="/login">Login</Link>
                    </li>
                    <li>
                        <Link to="/register">Register</Link>
                    </li>
                </ul>
                <Route path="/login" component={Login}/>
                <Route path="/register" component={Register}/>
            </div>
        </Router>
        
    );
}