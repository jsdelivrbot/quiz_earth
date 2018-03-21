import { Injectable } from '@angular/core';

/*
  Generated class for the ServiceProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class ServiceProvider {

  public usrData: any;
  public dat: any;

  constructor() {
      this.usrData="";
  }

  setUserData(usrData){
      this.usrData=usrData;
  }

  setLatLon(dat){
      this.dat=dat;
  }

  getUserData() {
      return this.usrData;
  }  

  getLatLon(){
      return this.dat;
  }
  

}
