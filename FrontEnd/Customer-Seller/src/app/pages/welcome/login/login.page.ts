import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ApiService } from 'src/app/services/api/api.service';
import { AuthService } from 'src/app/services/auth/auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {

  form = {
    phone_tmu : '',
    password : ''
  }

  constructor(
    private api : ApiService,
  ) { }

  ngOnInit() {
  }

  doLogin(){
    this.api.loginUser(this.form)
  }

}
