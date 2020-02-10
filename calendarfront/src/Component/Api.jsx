export default {
    getToken: (email, password) => {
        return new Promise((resolve,reject) => {
            fetch("https://127.0.0.1:8000/api/auth", {
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
    
    Register: (username, email, password) => {
        return new Promise((resolve, reject) => {
            fetch("http://127.0.0.1:8000/api/users", {
                method: 'POST',
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded"
                },
                body: JSON.stringify({"username": username, "email" : email, "password": password})
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

    Profile: (username, email, password) => {
        return new Promise((resolve, reject) => {
            fetch("http://127.0.0.1:8000/api/users/me", {
                method: 'POST',
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded"
                },
                body: JSON.stringify({"username": username, "email" : email, "password": password})
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
    
    
}