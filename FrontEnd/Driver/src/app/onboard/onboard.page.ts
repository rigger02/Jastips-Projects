import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-onboard',
  templateUrl: './onboard.page.html',
  styleUrls: ['./onboard.page.scss'],
})
export class OnboardPage implements OnInit {

  constructor(
    private router: Router
  ) { }

  ngOnInit() {
    let token = localStorage.getItem('token')
    if(token){
      this.router.navigateByUrl('/tabs/tab1')
    }
  }

}
