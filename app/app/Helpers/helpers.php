<?php
    /**
     * Function to interpret the success response
     * 
     * @param $data as the response data
     * @param $statusCode as the response status code
     * 
     * @return success json response 
     */
    function interpretJsonResponse($status, $statusCode, $data = null, $message = null, $count = 0) {
        if(! empty($count)) {
            $finalMsg = '';
            
            if(! empty($message)) {
                $finalMsg = $message;
            } else {
                if( is_array($data) && empty($data) ) { 
                    $finalMsg = 'No Records Found';
                } else if($data instanceof Illuminate\Database\Eloquent\Collection && $data->isEmpty()) {
                    $finalMsg = 'No Records Found';
                }
            }

            return response()->json(
                [
                    'success' => $status, 
                    'data' => (! empty($data)) ? $data : [],
                    'count' => $count,
                    'message' => $finalMsg, 
                    'status' => $statusCode
                ], 200);
        } else {
            $finalMsg = '';
            
            if(! empty($message)) {
                $finalMsg = $message;
            } else {
                if( is_array($data) && empty($data) ) { 
                    $finalMsg = 'No Records Found';
                } else if($data instanceof Illuminate\Database\Eloquent\Collection && $data->isEmpty()) {
                    $finalMsg = 'No Records Found';
                }
            }

            return response()->json(
                [
                    'success' => $status, 
                    'data' => (! empty($data)) ? $data : [],
                    'message' => $finalMsg, 
                    'status' => $statusCode
                ], 200);
        }
    }

    /**
     * Function to show only date
     * 
     * @param $dt as the date object
     * 
     * @return formatted date 
     */
    function show_date($dt, $format = null){
        $format = (! empty($format)) ? $format : config('constants.DATE_FORMAT');
        return date($format, strtotime($dt));
    }

?>