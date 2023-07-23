import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ApiService } from 'src/app/services/api/api.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.page.html',
  styleUrls: ['./register.page.scss'],
})
export class RegisterPage implements OnInit {

  form = {
    name_tmu : '',
    phone_tmu : '',
    password : ''
  }

    
    constructor(
      private api : ApiService
    ) { }

  ngOnInit() {
  }

  doRegis(){
      this.api.registerUser(this.form)
  }

}
