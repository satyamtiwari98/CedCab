<?php

include_once 'Dbcon.php';
// session_start();

class Ride extends Dbcon {

    const table_ride = 'tbl_ride';
    public $user_id;
    public $connect;
    public $ride_id;
    public $ride_date;
    public $pickupPoint;
    public $dropPoint;
    public $totalDistance;
    public $luggage;
    public $TotalFare;
    public $status;
    public $customer_user_id;
    public $obj;
    public $distance1;
    public $distance2;
    public $cabType;
    public $data = array();

    public function __construct()
    {
        $lets_connect = new Dbcon();
        $this->connect = $lets_connect->connect;

    }


    public function CalculateFare($cabType,$luggage,$pickupPoint,$dropPoint,$totalDistance,$distance1,$distance2){

        $this->distance1 = $distance1;
        $this->distance2 = $distance2;

        $this->pickupPoint = $pickupPoint;
        $this->dropPoint = $dropPoint;
        $this->cabType = $cabType;
        $this->luggage = $luggage;
        $this->totalDistance = $totalDistance;

        $_SESSION['ride']['pickup']=$this->distance1;
        $_SESSION['ride']['drop']=$this->distance2;
        $_SESSION['ride']['cabtype']=$this->cabType;
        $_SESSION['ride']['luggage']=$this->luggage;
        $_SESSION['ride']['totaldistance']=$this->totalDistance;
      

        switch($this->cabType){

            case 'CedMini':
               $miniFixed=150;
              $distance = $this->totalDistance;

              if($distance<=10) {

                $fare =0;
                $fare = ($distance*14.50)+$miniFixed;

                if($this->luggage<=10) {

                      $fare+=50;

                  }else if($this->luggage>10&&$this->luggage<=20) {

                      $fare+=100;

                  }else if($this->luggage>20) {

                      $fare+=200;

                  }
                  $_SESSION['ride']['fare']=$fare;

                  return $fare;

              }else if($distance>10 && $distance<=50) {

                $fare =0;
                $fare = 10*14.50;
                $distance-=10;
                $fare+=$distance*13;
                $fare+=$miniFixed;

                  if($this->luggage<=10) {

                    $fare+=50;

                }else if($this->luggage>10 && $this->luggage<=20) {

                    $fare+=100;

                }else if($this->luggage>20) {

                    $fare+=200;

                }
                $_SESSION['ride']['fare']=$fare;


                  return $fare;

              }else if($distance>50 && $distance<=100) {

                $fare =0;
                $fare = 10*14.50;
                $distance-=10;
                $fare+=50*13;
                $distance-=50;
                $fare+=$distance*11.20;
                $fare+=$miniFixed;

                if($this->luggage<=10) {

                    $fare+=50;

                }else if($this->luggage>10 && $this->luggage<=20) {

                    $fare+=100;

                }else if($this->luggage>20) {

                    $fare+=200;

                }
                $_SESSION['ride']['fare']=$fare;


                return $fare;

              }else if($distance>100) {

                  $fare =0;
                $fare = 10*14.50;
                $distance = $distance-10;
                  $fare += 50*13;
                  $distance = $distance-50;
                  $fare += 100*11.20;
                  $distance = $distance-100;
                  $fare+=$distance*9.50;
                  $fare = $fare+$miniFixed;

                  if($this->luggage<=10) {

                    $fare+=50;

                }else if($this->luggage>10 && $this->luggage<=20) {

                    $fare+=100;

                }else if($this->luggage>20) {
                     
                    $fare+=200;

                }
                $_SESSION['ride']['fare']=$fare;

                  return $fare;

              }

              break;

            case 'CedRoyal':
                $miniFixed=200;
                $distance = $this->totalDistance;

                if($distance<=10) {

                    $fare =0;
                    $fare = ($distance*15.50)+$miniFixed;

                    if($this->luggage<=10) {

                        $fare+=50;

                    }else if($this->luggage>10 && $this->luggage<=20) {

                        $fare+=100;

                    }else if($this->luggage>20) {

                        $fare+=200;

                    }
                    $_SESSION['ride']['fare']=$fare;

                    return $fare;

                }else if($distance>10 && $distance<=50) {

                    $fare =0;
                    $fare = 10*15.50;
                    $distance-=10;
                    $fare+=$distance*14;
                    $fare+=$miniFixed;

                    if($this->luggage<=10) {

                      $fare+=50;

                  }else if($this->luggage>10 && $this->luggage<=20) {
                       
                      $fare+=100;

                  }else if($this->luggage>20) {

                      $fare+=200;

                  }
                  $_SESSION['ride']['fare']=$fare;

                    return $fare;

                }else if($distance>50 && $distance<=100) {

                    $fare =0;
                    $fare = 10*15.50;
                    $distance-=10;
                    $fare+=50*14;
                    $distance-=50;
                    $fare+=$distance*12.20;
                    $fare+=$miniFixed;

                    if($this->luggage<=10) {

                      $fare+=50;

                  }else if($this->luggage>10 && $this->luggage<=20) {

                      $fare+=100;

                  }else if($this->luggage>20) {

                      $fare+=200;

                  }
                  $_SESSION['ride']['fare']=$fare;

                    return $fare;

                }else if($distance>100) {

                    $fare =0;
                  $fare = 10*15.50;
                    $distance = $distance-10;
                    $fare += 50*14;
                    $distance = $distance-50;
                    $fare += 100*12.20;
                    $distance = $distance-100;
                    $fare+=$distance*10.50;
                    $fare = $fare+$miniFixed;

                    if($this->luggage<=10) {

                      $fare+=50;

                  }else if($this->luggage>10 && $this->luggage<=20) {

                      $fare+=100;

                  }else if($this->luggage>20) {

                      $fare+=200;

                  }
                  $_SESSION['ride']['fare']=$fare;

                    return $fare;

                }
                

                break;

            case 'CedSUV':
                    $miniFixed=250;
                    $distance = $this->totalDistance;

                    if($distance<=10) {

                        $fare =0;
                        $fare = ($distance*16.50)+$miniFixed;

                        if($this->luggage<=10) {

                            $fare+=100;

                        }else if($this->luggage>10 && $this->luggage<=20) {

                            $fare+=200;

                        }else if($this->luggage>20) {

                            $fare+=400;

                        }
                        $_SESSION['ride']['fare']=$fare;

                        return $fare;

                    }else if($distance>10 && $distance<=50) {

                        $fare =0;
                        $fare = 10*16.50;
                        $distance-=10;
                        $fare+=$distance*15;
                        $fare+=$miniFixed;

                        if($this->luggage<=10) {

                          $fare+=100;

                      }else if($this->luggage>10 && $this->luggage<=20) {

                          $fare+=200;

                      }else if($this->luggage>20) {

                          $fare+=400;

                      }
                      $_SESSION['ride']['fare']=$fare;

                        return $fare;

                    }else if($distance>50 && $distance<=100) {

                        $fare =0;
                        $fare = 10*16.50;
                        $distance-=10;
                        $fare+=50*15;
                        $distance-=50;
                        $fare+=$distance*13.20;
                        $fare+=$miniFixed;

                        if($this->luggage<=10) {

                          $fare+=100;

                      }else if($this->luggage>10 && $this->luggage<=20) {

                          $fare+=200;

                      }else if($this->luggage>20) {

                          $fare+=400;

                      }
                      $_SESSION['ride']['fare']=$fare;

                        return $fare;

                    }else if($distance>100) {

                        $fare =0;
                      $fare = 10*16.50;
                        $distance = $distance-10;
                        $fare += 50*15;
                        $distance = $distance-50;
                        $fare += 100*13.20;
                        $distance = $distance-100;
                        $fare+=$distance*11.50;
                        $fare = $fare+$miniFixed;

                        if($this->luggage<=10) {

                          $fare+=100;

                      }else if($this->luggage>10 && $this->luggage<=20) {

                          $fare+=200;

                      }else if($this->luggage>20) {

                          $fare+=400;

                      }
                      $_SESSION['ride']['fare']=$fare;

                        return $fare;

                    }

                    break;

                case 'CedMicro':
                        $miniFixed=50;
                        $distance = $this->totalDistance;

                        if($distance<=10) {

                            $fare =0;
                            $fare = ($distance*13.50)+$miniFixed;
                            $_SESSION['ride']['fare']=$fare;
                           
                            return $fare;

                        }else if($distance>10 && $distance<=50) {

                            $fare =0;
                            $fare = 10*13.50;
                            $distance-=10;
                            $fare+=$distance*12;
                            $fare+=$miniFixed;
                            $_SESSION['ride']['fare']=$fare;
                           
                            return $fare;

                        }else if($distance>50 && $distance<=100) {

                            $fare =0;
                            $fare = 10*13.50;
                            $distance-=10;
                            $fare+=50*12;
                            $distance-=50;
                            $fare+=$distance*10.20;
                            $fare+=$miniFixed;
                            $_SESSION['ride']['fare']=$fare;
                          
                            return $fare;

                        }else if($distance>100) {

                            $fare =0;
                          $fare = 10*13.50;
                            $distance = $distance-10;
                            $fare += 50*12;
                            $distance = $distance-50;
                            $fare += 100*10.20;
                            $distance = $distance-100;
                            $fare+=$distance*8.50;
                            $fare = $fare+$miniFixed;
                            $_SESSION['ride']['fare']=$fare;
                          
                            return $fare;
                        }
    
                
    
            }


       


    }

    public function BookRide($pickup,$drop,$cab,$luggage,$fare,$total,$id){

        $this->pickupPoint = $pickup;
        $this->dropPoint = $drop;
        $this->cabType = $cab;
        $this->luggage = $luggage;
        $this->totalDistance = $total;
        $this->TotalFare = $fare;
        $this->user_id = $id;

        $sqlQuery = "insert into `".self::table_ride."` (`ride_date`,`from`,`to`,`cab_type`,`total_distance`,`luggage`,`total_fare`,`status`,`customer_user_id`) values (now(),'$this->pickupPoint','$this->dropPoint','$this->cabType','$this->totalDistance','$this->luggage','$this->TotalFare','1','$this->user_id')";
        

        
        if ($this->connect->query($sqlQuery) == TRUE) {

            if(isset($_SESSION['ride']['pickup'])){
                unset($_SESSION['ride']['pickup']);
                unset($_SESSION['ride']['drop']);
                unset($_SESSION['ride']['cabtype']);
                unset($_SESSION['ride']['fare']);
                unset($_SESSION['ride']['luggage']);
                unset($_SESSION['ride']['totaldistance']);

            }

            return 1;

          } else {

         return 0;

          }

    }

    public function GetPendingRides($user_id){

        $this->user_id = $user_id;
        $sqlQuery = "Select * from `".self::table_ride."` where `customer_user_id`='$this->user_id' and `status`='1'";

        $result = $this->connect->query($sqlQuery);

        if($result->num_rows>0) {
            $i=0;
            while($row = $result->fetch_assoc()) {
                $this->data[$i] = $row;
                ++$i;
              }
            
        }

        return $this->data;


    }


    public function GetAllRides($user_id){

        $this->user_id = $user_id;

        $sqlQuery = "Select * from `".self::table_ride."` where `customer_user_id`='$this->user_id'";
        $result = $this->connect->query($sqlQuery);

        if($result->num_rows>0) {
            $i=0;
            while($row = $result->fetch_assoc()) {
                $this->data[$i] = $row;
                ++$i;
              }
            
        }

        return $this->data;

    }

    public function GetCompletedRides($user_id){

        $this->user_id = $user_id;

        $sqlQuery = "Select * from `".self::table_ride."` where `customer_user_id`='$this->user_id' and `status`='2'";
        $result = $this->connect->query($sqlQuery);

        if($result->num_rows>0) {
            $i=0;
            while($row = $result->fetch_assoc()) {
                $this->data[$i] = $row;
                ++$i;
              }
            
        }

        return $this->data;

    }

    public function GetCancelledRides($user_id){

        $this->user_id = $user_id;

        $sqlQuery = "Select * from `".self::table_ride."` where `customer_user_id`='$this->user_id' and `status`='0'";
        $result = $this->connect->query($sqlQuery);

        if($result->num_rows>0) {
            $i=0;
            while($row = $result->fetch_assoc()) {
                $this->data[$i] = $row;
                ++$i;
              }
            
        }

        return $this->data;

    }

    public function GetTotalExpenses($user_id){
        $this->user_id = $user_id;

        $sqlQuery = "select sum(`total_fare`) from `".self::table_ride."` where `customer_user_id` = '$this->user_id' and `status`='2'";
// die($sqlQuery);
        $result = $this->connect->query($sqlQuery);
        if($result->num_rows>0){
            $row = $result->fetch_assoc();
        }
        
        // die($result[0]);

        return $row;

    }

    public function CancelRide($ride_id) {

        $this->ride_id = $ride_id;

        $sqlQuery = "update `".self::table_ride."` set `status`='0' where `ride_id`='$this->ride_id' and `status`='1'";
// die($sqlQuery);
        $result = $this->connect->query($sqlQuery);


        if($result == true) {

            return 1;

        }else {

            return 0;

        }

    }






}