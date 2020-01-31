export default {
    getToken: () => {
        var myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");

        var raw = JSON.stringify({"username":"samuel","password":"motdepas"});

        var requestOptions = {
            method: 'POST',
            headers: myHeaders,
            body: raw,
            redirect: 'follow'
        };

        fetch("http://127.0.0.1:8000/api/auth", requestOptions)
        .then(response => response.text())
        .then(result => console.log(result))
        .catch(error => console.log('error', error));
    },
    
    Register: (firstname, lastname, email, password) => {
        return new Promise((resolve, reject) => {
            fetch("http://localhost:8000/api/users", {
                method: 'POST',
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded"
                },
                body: JSON.stringify({"firstname": firstname, "lastname": lastname, "email" : email, "password": password})
            }).then((data) => {
                data.json().then((json) => {
                    resolve(json)
                }).catch((errors)=>{
                    reject()
                    console.error('errors',errors)
                    
                })
            })
        })
    },
    Logout: () => {
        return new Promise((resolve, reject) => {
            fetch("https://testsamheroku.herokuapp.com/api/auth/register", {
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