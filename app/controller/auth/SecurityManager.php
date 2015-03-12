<?php
    /* These constants should not be changed unless the passwords for all users are reset.
     * The one exclusion of this is the iteration count (PBKDF2_ITERATIONS).
     * This iteration count should be upgraded to the double value of it every 2 years to keep up with Moore's Law (20000 becomes 40000).
     * It should be noted that the iteration count should be benchmarked since the hashing process should be slow, but not slow enough for the user to notice the delay.
     */
    define("PBKDF2_HASH_ALGORITHM", "sha512");
    define("PBKDF2_ITERATIONS", 20000);
    define("PBKDF2_SALT_BYTE_SIZE", 128);
    define("PBKDF2_HASH_BYTE_SIZE", 128);

    class SecurityManager
    {
        // Create a first time hash
        public function createFirstTimeHash($password, $salt)
        {
            return base64_decode
            (
                $this->pbkdf2
                (
                    PBKDF2_HASH_ALGORITHM,
                    $password,
                    $salt,
                    PBKDF2_ITERATIONS,
                    PBKDF2_HASH_BYTE_SIZE,
                    true
                )
            );
        }

        public function generateSalt()
        {
            return $salt = base64_encode(mcrypt_create_iv(PBKDF2_SALT_BYTE_SIZE, MCRYPT_DEV_URANDOM));
        }

        // Validates a given password and salt with a correct hash (the user's password + salt combination)
        public function validatePassword($password, $salt, $correctHash)
        {
            $pbkdf2 = base64_decode($correctHash);

            return $this->slowEquals
            (
                $pbkdf2,
                $this->pbkdf2
                (
                    PBKDF2_HASH_ALGORITHM,
                    $password,
                    $salt,
                    PBKDF2_ITERATIONS,
                    PBKDF2_HASH_BYTE_SIZE,
                    true
                )
            );
        }

        // Compares two strings $a and $b in length-constant time.
        private function slowEquals($a, $b)
        {
            $diff = strlen($a) ^ strlen($b);

            for($i = 0; $i < strlen($a) && $i < strlen($b); $i++)
            {
                $diff |= ord($a[$i]) ^ ord($b[$i]);
            }
            return $diff === 0;
        }

        // The PBKDF2 hashing and key stretching algorithm
        private function pbkdf2($algorithm, $password, $salt, $count, $keyLength, $rawOutput = false)
        {
            $algorithm = strtolower($algorithm);

            if (!in_array($algorithm, hash_algos(), true))
            {
                trigger_error("PBKDF2 ERROR: Invalid hashing algorithm.",  E_USER_ERROR);
            }

            if ($count <= 0 || $keyLength <= 0)
            {
                trigger_error("PBKDF2 ERROR: Invalid parameters.", E_USER_ERROR);
            }
            $hash_length = strlen(hash($algorithm, "", true));
            $block_count = ceil($keyLength / $hash_length);

            $output = "";

            for ($i = 1; $i <= $block_count; $i++)
            {
                // $i encoded as 4 bytes, big endian.
                $last = $salt . pack("N", $i);
                // First iteration
                $last = $xorsum = hash_hmac($algorithm, $last, $password, true);
                // Perform the other $count - 1 iterations
                for ($j = 1; $j < $count; $j++)
                {
                    $xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
                }
                $output .= $xorsum;
            }

            if ($rawOutput)
            {
                return substr($output, 0, $keyLength);
            }
            else
            {
                return bin2hex(substr($output, 0, $keyLength));
            }
        }
    }
?>