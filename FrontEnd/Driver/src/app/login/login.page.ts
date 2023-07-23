import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ApiService } from '../services/api/api.service';
import { AuthService } from '../services/auth/auth.service';

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
    private router : Router,
    private api: ApiService,
    private auth: AuthService
  ) { }

  ngOnInit() {
  }
  doLogin(){
    this.api.loginDriver(this.form).subscribe(
      (res:any) => {
        localStorage.setItem('role', res['data'].role);
        this.auth.setToken(res['token'])
        this.router.navigateByUrl('tabs')
      })
  }
}
