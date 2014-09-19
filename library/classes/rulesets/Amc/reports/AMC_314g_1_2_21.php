<?php
// Copyright (C) 2014 Ensoftek
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//


class AMC_314g_1_2_21 extends AbstractAmcReport
{
    public function getTitle()
    {
        return "AMC_314g_1_2_21";
    }

    public function getObjectToCount()
    {
        return "encounters";
    }
 
    public function createDenominator() 
    {
        return new AMC_314g_1_2_21_Denominator();
    }
    
    public function createNumerator()
    {
        return new AMC_314g_1_2_21_Numerator();
    }
}
