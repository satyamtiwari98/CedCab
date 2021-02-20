<?php

class Cab {
    
    public $cabType;
    public $luggage;
    public $distance1;
    public $distance2;

    function __construct($cabType,$luggage,$distance1,$distance2)
    {
        $this->distance1 = $distance1;
        $this->distance2 = $distance2;
        $this->cabType = $cabType;
        $this->luggage = $luggage;
    }

    function calculateFare(){

        switch($this->cabType){

        case 'CedMini':
           $miniFixed=150;
          $distance = abs($this->distance1-$this->distance2);
          if($distance<=10){
            $fare =0;
              $fare = ($distance*14.50)+$miniFixed;
              if($this->luggage<=10){
                  $fare+=50;
              }else if($this->luggage>10&&$this->luggage<=20){
                  $fare+=100;
              }else if($this->luggage>20){
                  $fare+=200;
              }
              return $fare;
          }else if($distance>10&&$distance<=50){
            $fare =0;
              $fare = 10*14.50;
              $distance-=10;
              $fare+=$distance*13;
              $fare+=$miniFixed;
              if($this->luggage<=10){
                $fare+=50;
            }else if($this->luggage>10&&$this->luggage<=20){
                $fare+=100;
            }else if($this->luggage>20){
                $fare+=200;
            }
              return $fare;
          }else if($distance>50&&$distance<=100){
            $fare =0;
              $fare = 10*14.50;
              $distance-=10;
              $fare+=50*13;
              $distance-=50;
              $fare+=$distance*11.20;
              $fare+=$miniFixed;
              if($this->luggage<=10){
                $fare+=50;
            }else if($this->luggage>10&&$this->luggage<=20){
                $fare+=100;
            }else if($this->luggage>20){
                $fare+=200;
            }
              return $fare;
          }else if($distance>100){
              $fare =0;
            $fare = 10*14.50;
              $distance = $distance-10;
              $fare += 50*13;
              $distance = $distance-50;
              $fare += 100*11.20;
              $distance = $distance-100;
              $fare+=$distance*9.50;
              $fare = $fare+$miniFixed;
              if($this->luggage<=10){
                $fare+=50;
            }else if($this->luggage>10&&$this->luggage<=20){
                $fare+=100;
            }else if($this->luggage>20){
                $fare+=200;
            }
              return $fare;
          }
          break;
          case 'CedRoyal':
            $miniFixed=200;
            $distance = abs($this->distance1-$this->distance2);
            if($distance<=10){
                $fare =0;
                $fare = ($distance*15.50)+$miniFixed;
                if($this->luggage<=10){
                    $fare+=50;
                }else if($this->luggage>10&&$this->luggage<=20){
                    $fare+=100;
                }else if($this->luggage>20){
                    $fare+=200;
                }
                return $fare;
            }else if($distance>10&&$distance<=50){
                $fare =0;
                $fare = 10*15.50;
                $distance-=10;
                $fare+=$distance*14;
                $fare+=$miniFixed;
                if($this->luggage<=10){
                  $fare+=50;
              }else if($this->luggage>10&&$this->luggage<=20){
                  $fare+=100;
              }else if($this->luggage>20){
                  $fare+=200;
              }
                return $fare;
            }else if($distance>50&&$distance<=100){
                $fare =0;
                $fare = 10*15.50;
                $distance-=10;
                $fare+=50*14;
                $distance-=50;
                $fare+=$distance*12.20;
                $fare+=$miniFixed;
                if($this->luggage<=10){
                  $fare+=50;
              }else if($this->luggage>10&&$this->luggage<=20){
                  $fare+=100;
              }else if($this->luggage>20){
                  $fare+=200;
              }
                return $fare;
            }else if($distance>100){
                $fare =0;
              $fare = 10*15.50;
                $distance = $distance-10;
                $fare += 50*14;
                $distance = $distance-50;
                $fare += 100*12.20;
                $distance = $distance-100;
                $fare+=$distance*10.50;
                $fare = $fare+$miniFixed;
                if($this->luggage<=10){
                  $fare+=50;
              }else if($this->luggage>10&&$this->luggage<=20){
                  $fare+=100;
              }else if($this->luggage>20){
                  $fare+=200;
              }
                return $fare;
            }
            break;
            case 'CedSUV':
                $miniFixed=250;
                $distance = abs($this->distance1-$this->distance2);
                if($distance<=10){
                    $fare =0;
                    $fare = ($distance*16.50)+$miniFixed;
                    if($this->luggage<=10){
                        $fare+=100;
                    }else if($this->luggage>10&&$this->luggage<=20){
                        $fare+=200;
                    }else if($this->luggage>20){
                        $fare+=400;
                    }
                    return $fare;
                }else if($distance>10&&$distance<=50){
                    $fare =0;
                    $fare = 10*16.50;
                    $distance-=10;
                    $fare+=$distance*15;
                    $fare+=$miniFixed;
                    if($this->luggage<=10){
                      $fare+=100;
                  }else if($this->luggage>10&&$this->luggage<=20){
                      $fare+=200;
                  }else if($this->luggage>20){
                      $fare+=400;
                  }
                    return $fare;
                }else if($distance>50&&$distance<=100){
                    $fare =0;
                    $fare = 10*16.50;
                    $distance-=10;
                    $fare+=50*15;
                    $distance-=50;
                    $fare+=$distance*13.20;
                    $fare+=$miniFixed;
                    if($this->luggage<=10){
                      $fare+=100;
                  }else if($this->luggage>10&&$this->luggage<=20){
                      $fare+=200;
                  }else if($this->luggage>20){
                      $fare+=400;
                  }
                    return $fare;
                }else if($distance>100){
                    $fare =0;
                  $fare = 10*16.50;
                    $distance = $distance-10;
                    $fare += 50*15;
                    $distance = $distance-50;
                    $fare += 100*13.20;
                    $distance = $distance-100;
                    $fare+=$distance*11.50;
                    $fare = $fare+$miniFixed;
                    if($this->luggage<=10){
                      $fare+=100;
                  }else if($this->luggage>10&&$this->luggage<=20){
                      $fare+=200;
                  }else if($this->luggage>20){
                      $fare+=400;
                  }
                    return $fare;
                }
                break;
                case 'CedMicro':
                    $miniFixed=50;
                    $distance = abs($this->distance1-$this->distance2);
                    if($distance<=10){
                        $fare =0;
                        $fare = ($distance*13.50)+$miniFixed;
                       
                        return $fare;
                    }else if($distance>10&&$distance<=50){
                        $fare =0;
                        $fare = 10*13.50;
                        $distance-=10;
                        $fare+=$distance*12;
                        $fare+=$miniFixed;
                       
                        return $fare;
                    }else if($distance>50&&$distance<=100){
                        $fare =0;
                        $fare = 10*13.50;
                        $distance-=10;
                        $fare+=50*12;
                        $distance-=50;
                        $fare+=$distance*10.20;
                        $fare+=$miniFixed;
                      
                        return $fare;
                    }else if($distance>100){
                        $fare =0;
                      $fare = 10*13.50;
                        $distance = $distance-10;
                        $fare += 50*12;
                        $distance = $distance-50;
                        $fare += 100*10.20;
                        $distance = $distance-100;
                        $fare+=$distance*8.50;
                        $fare = $fare+$miniFixed;
                      
                        return $fare;
                    }

            

        }
    }

}