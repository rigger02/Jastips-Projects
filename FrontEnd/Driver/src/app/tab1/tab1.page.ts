import { Component, OnInit } from '@angular/core';
import { ApiService } from '../services/api/api.service';

@Component({
  selector: 'app-tab1',
  templateUrl: 'tab1.page.html',
  styleUrls: ['tab1.page.scss']
})
export class Tab1Page implements OnInit{

  constructor(
    private api: ApiService
  ) {}

  history:any[] =[]

  ngOnInit(){
    this.getOrderHistory()
  }

  getOrderHistory(){
    this.api.getOrderHistory().subscribe((res:any) => {
      this.history = res['data']
      console.log(this.history)
    })
  }



}


