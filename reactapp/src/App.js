import React from 'react';
import './App.css';
const validEmailRegex = RegExp(
    /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i
);
const validateForm = errors => {
    let valid = true;
    Object.values(errors).forEach(val => val.length > 0 && (valid = false));
    return valid;
};

const url = 'http://127.0.0.1:8000/api/addSubscriber';

export default class App extends React.Component {
        constructor(props) {
            super(props);
            this.state = {
                fullName: null,
                email: null,
                errors: {
                    fullName: '',
                    email: ''
                }
            };
        }


        handleChange = (event) => {
            event.preventDefault();
            const {
                name,
                value
            } = event.target;
            let errors = this.state.errors;

            switch (name) {
                case 'fullName':
                    errors.fullName =
                        value.length < 5 ?
                        'Full Name must be at least 5 characters long!' :
                        '';
                    break;
                case 'email':
                    errors.email =
                        validEmailRegex.test(value) ?
                        '' :
                        'Email is not valid!';
                    break;

                default:
                    break;
            }

            this.setState({
                errors,
                [name]: value
            });
        }

        handleSubmit = (event) => {
            event.preventDefault();
            console.info(this.state)
            if (validateForm(this.state.errors)) {
                console.info('Valid Form');
		 fetch(url, {
		      method: "POST",
		      headers: {
			'Content-Type': 'application/json',
			Accept: 'application/json'
		      },
		      body: JSON.stringify({
			fullName: this.state.fullName,
			email: this.state.email
		      })
		    })
		    .then(resp => {
                if(resp.status!=200){
                    alert('Bad request');
                }else{
                    alert('Form submitted successfully!')
                }
		    })
		    

            } else {
                console.error('Invalid Form')
            }
        }

        render() {
                const {
                    errors
                } = this.state;
                return ( <
                    div className = 'wrapper' >
                    <
                    div className = 'form-wrapper' >
                    <
                    h2 > Please enter details< /h2> <
                    form onSubmit = {
                        this.handleSubmit
                    }
                    noValidate >
                    <
                    div className = 'fullName' >
                    <
                    label htmlFor = "fullName" > Full Name < /label> <
                    input type = 'text'
                    name = 'fullName'
                    onChange = {
                        this.handleChange
                    }
                    noValidate / > {
                        errors.fullName.length > 0 &&
                        <
                        span className = 'error' > {
                            errors.fullName
                        } < /span>} <
                        /div><p></p >

                        <
                        div className = 'email' >
                        <
                        label htmlFor = "email" > Email < /label> <
                        input type = 'email'
                        name = 'email'
                        onChange = {
                            this.handleChange
                        }
                        noValidate / > {
                            errors.email.length > 0 &&
                            <
                            span className = 'error' > {
                                errors.email
                            } < /span>} <
                            /div><p></p >

                            <
                            div className = 'submit' >
                            <
                            button > submit < /button> <
                            /div> <
                            /form> <
                            /div> <
                            /div>
                        );
                    }
                }
