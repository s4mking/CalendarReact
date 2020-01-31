export default {
    getToken: (email, password) => {
        return new Promise((resolve,reject) => {
            fetch("http://127.0.0.1:8000/api/auth", {
                method: 'POST',
                headers: {
                    'Content-Type': "application/json"
                },
                body: JSON.stringify({"username": email ,"password": password })
            }).then((data) => {
                data.json().then((json) => {
                    if (json.token) {
                        localStorage.setItem("token", json.token);
                        resolve(json)
                    } 
                }).catch((errors)=>{
                    reject(errors)
                    console.log(errors)
                })
            })
        })
    },
    
    Register: (firstname, lastname, email, password) => {
        var myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

        var raw = " {\n    \"username\":\"test4\",\"password\":\"motdepas\", \"email\":\"test4@test.test\"\n}";

        var requestOptions = {
        method: 'POST',
        headers: myHeaders,
        body: raw,
        redirect: 'follow'
        };

        fetch("http://localhost:8000/api/users", requestOptions)
        .then(response => response.text())
        .then(result => console.log(result))
        .catch(error => console.log('error', error));
    },
    Logout: () => {
        return new Promise((resolve, reject) => {
            fetch("http://localhost:8000/api/logout", {
                method: 'POST',
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded"
                },
                // body: JSON.stringify({"firstname": firstname, "lastname": lastname, "email" : email, "password": password})
            }).then((data) => {
                data.json().then((json) => {
                    resolve(json)
                }).catch((errors)=>{
                    reject()
                    console.error('errors',errors)
                    
                })
            })
        })
    }
    
}