import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Preferences } from '@capacitor/preferences';
import { interval } from 'rxjs';

@Component({
  selector: 'app-account',
  templateUrl: './account.page.html',
  styleUrls: ['./account.page.scss'],
})
export class AccountPage implements OnInit {

  isLogin: boolean = false
  constructor(
    private router:Router

  ) { }

  ngOnInit() {
    const token = localStorage.getItem('token')
    if(token){
      this.isLogin = true}
    interval(1000).subscribe(() =>{
      const token = localStorage.getItem('token')
      if(token){
        this.isLogin = true
      }
    });

  }

  async logout(){
    Preferences.clear()
    localStorage.clear()
    await this.router.navigateByUrl("/c-tabs")
  }

  handleRefresh(event) {
    setTimeout(() => {
      // Any calls to load data go here
      location.reload();
      event.target.complete();
      console.log(event)
    }, 2000);
  }

  // async canDismiss(data?: any, role?: string) {
  //   return role !== 'gesture';
  // }

}
