import React from 'react';
import styles from './Alert.module.sass';

type Props = {
  message: string | null;
};

const AlertSuccess: React.FC<Props> = ({ message}) => {
  return message ? (
    <div
      className={styles.alert + ' ' + styles.success}
      data-testid="alert-success"
    >
      {message}
    </div>
  ) : null;
};

export default AlertSuccess;
