import React from 'react';
import styles from './Alert.module.sass';

type Props = {
  message: string | null;
};

const AlertError: React.FC<Props> = ({ message }) => {
  return message ? (
    <div
      className={styles.alert + ' ' + styles.error}
      data-testid="alert-error"
    >
      {message}
    </div>
  ) : null;
};

export default AlertError;
